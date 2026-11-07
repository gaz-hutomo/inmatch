<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function dashboard(\Illuminate\Http\Request $request)
    {
        $categories = \App\Models\Category::all();

        $query = \App\Models\User::role('influencer')->where('status', 'approved')->with('profile');
        $influencers = $query->get();

        $searchCategory = $request->get('category_id');
        $searchBudget = $request->get('budget');
        $searchLocation = $request->get('location');

        if ($searchCategory || $searchBudget || $searchLocation) {
            $influencers = $influencers->map(function ($influencer) use ($searchCategory, $searchBudget, $searchLocation) {
                $score = 0;
                $profile = $influencer->profile;

                if ($profile) {
                    // Category (40%)
                    if ($searchCategory) {
                        if ($profile->primary_category_id == $searchCategory) {
                            $score += 0.40;
                        } elseif ($profile->secondary_category_id == $searchCategory) {
                            $score += 0.20;
                        }
                    } else {
                        $score += 0.40;
                    }

                    // Budget (30%)
                    if ($searchBudget) {
                        if ($profile->min_price && $profile->min_price <= $searchBudget) {
                            $score += 0.30;
                        } elseif ($profile->min_price && $profile->min_price <= $searchBudget * 1.2) {
                            $score += 0.15;
                        }
                    } else {
                        $score += 0.30;
                    }

                    // Location (20%)
                    if ($searchLocation) {
                        if ($profile->city && strtolower(trim($profile->city)) === strtolower(trim($searchLocation))) {
                            $score += 0.20;
                        }
                    } else {
                        $score += 0.20;
                    }
                    
                    // Popularity (10%)
                    $completed = $influencer->influencerEndorsements()->where('status', 'completed')->count();
                    $popularityScore = min($completed / 10, 1.0) * 0.10;
                    $score += $popularityScore;
                }

                $influencer->match_score = round($score * 100);
                return $influencer;
            })->sortByDesc('match_score')->values();
        } else {
            $influencers->each(function($inf) {
                $inf->match_score = null;
            });
        }

        return view('vendor.dashboard', compact('influencers', 'categories'));
    }

    public function showInfluencer($id)
    {
        $influencer = \App\Models\User::role('influencer')->with(['profile', 'mediaUploads'])->findOrFail($id);
        return view('vendor.influencer-show', compact('influencer'));
    }

    public function profile()
    {
        $user = auth()->user();
        $profile = $user->profile()->firstOrCreate([]);
        $mediaUploads = $user->mediaUploads()->latest()->get();
        return view('vendor.profile', compact('user', 'profile', 'mediaUploads'));
    }

    public function editProfile()
    {
        $user = auth()->user();
        $profile = $user->profile()->firstOrCreate([]);
        return view('vendor.profile-edit', compact('user', 'profile'));
    }

    public function updateProfile(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'bio' => 'nullable|string',
            'city' => 'nullable|string|max:255',
        ]);

        $profile = auth()->user()->profile;
        $data = $request->only('bio', 'city');

        if ($request->hasFile('avatar')) {
            if ($profile->avatar) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($profile->avatar);
            }
            $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        $profile->update($data);

        return redirect()->route('vendor.profile')->with('status', 'Profil perusahaan berhasil diperbarui!');
    }

    public function collaborations()
    {
        $endorsements = auth()->user()->vendorEndorsements()->with('influencer')->latest()->get();
        return view('vendor.collaborations', compact('endorsements'));
    }
}
