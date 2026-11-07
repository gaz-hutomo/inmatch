<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CreatorController extends Controller
{
    public function dashboard()
    {
        return view('creator.dashboard');
    }

    public function profile()
    {
        $user = auth()->user();
        $profile = $user->profile()->firstOrCreate([]);
        $profile->load('categories');
        $mediaUploads = $user->mediaUploads()->latest()->get();
        return view('creator.profile', compact('user', 'profile', 'mediaUploads'));
    }

    public function editProfile()
    {
        $user = auth()->user();
        $profile = $user->profile()->firstOrCreate([]);
        $profile->load('categories');
        $categories = Category::all();
        return view('creator.profile-edit', compact('user', 'profile', 'categories'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'bio' => 'nullable|string',
            'city' => 'nullable|string|max:255',
            'min_price' => 'nullable|numeric|min:0',
            'categories' => 'required|array|min:1|max:3',
            'categories.*' => 'exists:categories,id',
        ], [
            'categories.required' => 'Pilih minimal 1 kategori keahlian.',
            'categories.min' => 'Pilih minimal 1 kategori keahlian.',
            'categories.max' => 'Anda maksimal dapat memilih 3 kategori keahlian.',
        ]);

        $profile = auth()->user()->profile()->firstOrCreate([]);
        $data = $request->only('bio', 'city', 'min_price');

        $selectedCategories = $request->input('categories', []);
        $data['primary_category_id'] = $selectedCategories[0] ?? null;
        $data['secondary_category_id'] = $selectedCategories[1] ?? null;

        if ($request->hasFile('avatar')) {
            if ($profile->avatar) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($profile->avatar);
            }
            $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        $profile->update($data);
        $profile->categories()->sync($selectedCategories);

        return redirect()->route('creator.profile')->with('status', 'Profil penyedia jasa berhasil diperbarui!');
    }

    public function collaborations()
    {
        $endorsements = auth()->user()->creatorEndorsements()->with(['client.profile'])->latest()->get();
        return view('creator.collaborations', compact('endorsements'));
    }
}

