<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\DynamicBackground;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_users' => User::count(),
            'pending_users' => User::where('status', 'pending')->count(),
            'active_backgrounds' => DynamicBackground::where('is_active', true)->count()
        ];
        return view('admin.dashboard', compact('stats'));
    }

    public function users()
    {
        $users = User::with('roles')->get();
        return view('admin.users', compact('users'));
    }

    public function backgrounds()
    {
        $backgrounds = DynamicBackground::all();
        $speed = \App\Models\Setting::where('key', 'bg_animation_speed')->value('value') ?? 'medium';
        $count = \App\Models\Setting::where('key', 'bg_element_count')->value('value') ?? 15;
        $shape = \App\Models\Setting::where('key', 'bg_element_shape')->value('value') ?? 'circle';
        return view('admin.backgrounds', compact('backgrounds', 'speed', 'count', 'shape'));
    }

    public function updateSettings(Request $request)
    {
        $request->validate([
            'speed' => 'required|in:slow,medium,fast',
            'count' => 'required|integer|min:1|max:100',
            'shape' => 'required|in:circle,square,cube,cylinder,pyramid,rhombus',
        ]);

        \App\Models\Setting::updateOrCreate(['key' => 'bg_animation_speed'], ['value' => $request->speed]);
        \App\Models\Setting::updateOrCreate(['key' => 'bg_element_count'], ['value' => $request->count]);
        \App\Models\Setting::updateOrCreate(['key' => 'bg_element_shape'], ['value' => $request->shape]);

        return back()->with('status', 'Pengaturan animasi berhasil diperbarui.');
    }

    public function updateUserStatus(Request $request, User $user)
    {
        $request->validate(['status' => 'required|in:pending,approved,banned']);
        $user->update(['status' => $request->status]);
        return back()->with('status', 'Status pengguna berhasil diperbarui.');
    }

    public function storeBackground(Request $request)
    {
        $request->validate([
            'type' => 'required|in:emoji,image,shape',
        ]);

        if ($request->type === 'image') {
            $request->validate(['image_file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048']);
            $path = $request->file('image_file')->store('backgrounds', 'public');
            
            DynamicBackground::create([
                'type' => 'image',
                'content' => $path,
                'is_active' => true,
            ]);
        } elseif ($request->type === 'shape') {
            $request->validate(['shape_content' => 'required|in:cube,cylinder,pyramid,rhombus,sphere,capsule,star,hexagon']);
            DynamicBackground::create([
                'type' => 'shape',
                'content' => $request->shape_content,
                'is_active' => true,
            ]);
        } else {
            $request->validate(['content' => 'required|string']);
            
            $inputContent = trim($request->content);
            
            // Jika ada koma, pisahkan berdasarkan koma. Jika tidak, pisahkan per karakter
            if (strpos($inputContent, ',') !== false) {
                $emojis = explode(',', $inputContent);
            } else {
                $inputContent = str_replace(' ', '', $inputContent);
                $emojis = mb_str_split($inputContent);
            }

            foreach ($emojis as $emoji) {
                $emoji = trim($emoji);
                if (!empty($emoji)) {
                    DynamicBackground::create([
                        'type' => 'emoji',
                        'content' => $emoji,
                        'is_active' => true,
                    ]);
                }
            }
        }

        return back()->with('status', 'Background berhasil ditambahkan.');
    }

    public function toggleBackground(DynamicBackground $background)
    {
        $background->update(['is_active' => !$background->is_active]);
        return back()->with('status', 'Status background diperbarui.');
    }
    
    public function deleteBackground(DynamicBackground $background)
    {
        $background->delete();
        return back()->with('status', 'Background berhasil dihapus.');
    }
}
