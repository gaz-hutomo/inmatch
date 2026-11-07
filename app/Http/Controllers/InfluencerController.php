<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InfluencerController extends Controller
{
    public function dashboard()
    {
        return view('influencer.dashboard');
    }

    public function profile()
    {
        $user = auth()->user();
        $profile = $user->profile()->firstOrCreate([]);
        $mediaUploads = $user->mediaUploads()->latest()->get();
        return view('influencer.profile', compact('user', 'profile', 'mediaUploads'));
    }

    public function editProfile()
    {
        $user = auth()->user();
        $profile = $user->profile()->firstOrCreate([]);
        $categories = \App\Models\Category::all();
        return view('influencer.profile-edit', compact('user', 'profile', 'categories'));
    }

    public function updateProfile(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'bio' => 'nullable|string',
            'city' => 'nullable|string|max:255',
            'min_price' => 'nullable|numeric|min:0',
            'primary_category_id' => 'nullable|exists:categories,id',
            'secondary_category_id' => 'nullable|exists:categories,id',
        ]);

        $profile = auth()->user()->profile;
        $data = $request->only('bio', 'city', 'min_price', 'primary_category_id', 'secondary_category_id');

        if ($request->hasFile('avatar')) {
            if ($profile->avatar) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($profile->avatar);
            }
            $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        $profile->update($data);

        return redirect()->route('influencer.profile')->with('status', 'Profil berhasil diperbarui!');
    }

    public function collaborations()
    {
        $endorsements = auth()->user()->influencerEndorsements()->with('vendor')->latest()->get();
        return view('influencer.collaborations', compact('endorsements'));
    }
}
