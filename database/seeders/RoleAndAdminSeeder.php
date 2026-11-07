<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleAndAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'admin']);
        \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'client']);
        \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'creator']);

        $admin = \App\Models\User::firstOrCreate(
            ['email' => 'admin@inmatch.com'],
            [
                'name' => 'Super Admin',
                'password' => bcrypt('password'),
                'status' => 'approved',
            ]
        );

        $admin->assignRole('admin');
    }
}
