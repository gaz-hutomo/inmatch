<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Hash;

class MigrateRolesAndUsersSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Ensure roles exist
        Role::firstOrCreate(['name' => 'admin']);
        Role::firstOrCreate(['name' => 'client']);
        Role::firstOrCreate(['name' => 'creator']);

        // 2. Categories
        $categories = Category::all();
        $videoEditor = $categories->where('name', 'Video Editor')->first();
        $fotoEditor = $categories->where('name', 'Foto Editor')->first();
        $graphicDesigner = $categories->where('name', 'Graphic Designer')->first();

        // 3. Update existing users
        $users = User::all();
        foreach ($users as $user) {
            // Update password to 'password' as requested in #5
            $user->password = Hash::make('password');
            $user->status = 'approved';
            $user->save();

            // Role migrations
            if ($user->hasRole('influencer') || str_contains(strtolower($user->email), 'inf')) {
                if ($user->hasRole('influencer')) {
                    $user->removeRole('influencer');
                }
                $user->assignRole('creator');

                // Assign sample categories to profile
                $profile = $user->profile()->firstOrCreate([]);
                if ($user->id % 3 == 0 && $videoEditor && $fotoEditor) {
                    $profile->categories()->sync([$videoEditor->id, $fotoEditor->id]);
                } elseif ($user->id % 3 == 1 && $fotoEditor && $graphicDesigner) {
                    $profile->categories()->sync([$fotoEditor->id, $graphicDesigner->id]);
                } elseif ($videoEditor && $fotoEditor && $graphicDesigner) {
                    $profile->categories()->sync([$videoEditor->id, $fotoEditor->id, $graphicDesigner->id]);
                }
            } elseif ($user->hasRole('vendor') || str_contains(strtolower($user->email), 'tts')) {
                if ($user->hasRole('vendor')) {
                    $user->removeRole('vendor');
                }
                $user->assignRole('client');
            } elseif ($user->hasRole('admin') || $user->email === 'admin@inmatch.com') {
                $user->assignRole('admin');
            }
        }

        // 4. Create default client and creator if they don't exist
        $client = User::firstOrCreate(
            ['email' => 'client@inmatch.com'],
            [
                'name' => 'Sample Client',
                'password' => Hash::make('password'),
                'status' => 'approved',
            ]
        );
        $client->syncRoles(['client']);
        $client->profile()->firstOrCreate([
            'bio' => 'Perusahaan digital mencari creative talent.',
            'city' => 'Jakarta',
        ]);

        $creator = User::firstOrCreate(
            ['email' => 'creator@inmatch.com'],
            [
                'name' => 'Creative Studio',
                'password' => Hash::make('password'),
                'status' => 'approved',
            ]
        );
        $creator->syncRoles(['creator']);
        $creatorProfile = $creator->profile()->firstOrCreate([
            'bio' => 'Spesialis video editing, foto editing, dan desain grafis profesional.',
            'city' => 'Jakarta',
            'min_price' => 250000,
        ]);
        if ($videoEditor && $fotoEditor && $graphicDesigner) {
            $creatorProfile->categories()->sync([$videoEditor->id, $fotoEditor->id, $graphicDesigner->id]);
        }
    }
}

