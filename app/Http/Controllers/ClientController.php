<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\User;

class ClientController extends Controller
{
    public function dashboard(Request $request)
    {
        $categories = Category::all();

        $query = User::role('creator')->where('status', 'approved')->with(['profile.categories']);
        $creators = $query->get();

        // Support multiple categories via checkboxes (categories[]) or legacy category_id
        $searchCategories = $request->input('categories', []);
        if (!is_array($searchCategories) && $request->filled('categories')) {
            $searchCategories = [$request->input('categories')];
        }
        if ($request->filled('category_id') && empty($searchCategories)) {
            $searchCategories = [$request->input('category_id')];
        }
        $searchCategories = array_filter(array_map('intval', (array) $searchCategories));

        $searchBudget = $request->get('budget');
        $searchLocation = $request->get('location');

        $hasFilter = !empty($searchCategories) || !empty($searchBudget) || !empty($searchLocation);

        if ($hasFilter) {
            $numRequestedCategories = count($searchCategories);

            $creators = $creators->map(function ($creator) use ($searchCategories, $numRequestedCategories, $searchBudget, $searchLocation) {
                $score = 0;
                $profile = $creator->profile;

                if ($profile) {
                    $creatorCategoryIds = $profile->categories->pluck('id')->toArray();

                    // 1. Category Matching (Bobot 40%) - Focus & Relevance Index
                    if ($numRequestedCategories > 0) {
                        $matchedCount = count(array_intersect($creatorCategoryIds, $searchCategories));
                        $totalCreatorCategories = count($creatorCategoryIds);

                        // Jaccard similarity index: Matched / (Requested + CreatorTotal - Matched)
                        // Memberikan skor 1.0 (penuh 40%) jika kreator spesialis murni (hanya memiliki skill yang dicari),
                        // dan memberi nilai proporsional untuk generalist (memiliki banyak skill lain di luar yang dicari).
                        $denominator = $numRequestedCategories + $totalCreatorCategories - $matchedCount;
                        $similarity = ($denominator > 0) ? ($matchedCount / $denominator) : 0;

                        $score += $similarity * 0.40;
                    } else {
                        // Jika client tidak memfilter kategori, beri bobot kategori penuh
                        $score += 0.40;
                    }

                    // 2. Budget Matching (Bobot 30%)
                    if ($searchBudget) {
                        if ($profile->min_price && $profile->min_price <= $searchBudget) {
                            $score += 0.30;
                        } elseif ($profile->min_price && $profile->min_price <= $searchBudget * 1.2) {
                            $score += 0.15;
                        }
                    } else {
                        $score += 0.30;
                    }

                    // 3. Location Matching (Bobot 20%)
                    if ($searchLocation) {
                        if ($profile->city && strtolower(trim($profile->city)) === strtolower(trim($searchLocation))) {
                            $score += 0.20;
                        }
                    } else {
                        $score += 0.20;
                    }
                    
                    // 4. Popularity / Completed projects (Bobot 10%)
                    $completed = $creator->creatorEndorsements()->where('status', 'completed')->count();
                    $popularityScore = min($completed / 10, 1.0) * 0.10;
                    $score += $popularityScore;
                }

                $creator->match_score = round($score * 100);
                return $creator;
            })->filter(function($creator) use ($searchCategories) {
                // Jika client memilih kategori, hanya tampilkan kreator yang memiliki minimal 1 skill yang dicari
                if (!empty($searchCategories)) {
                    $creatorCategoryIds = $creator->profile ? $creator->profile->categories->pluck('id')->toArray() : [];
                    return count(array_intersect($creatorCategoryIds, $searchCategories)) > 0;
                }
                return true;
            })->sortByDesc('match_score')->values();
        } else {
            $creators->each(function($creator) {
                $creator->match_score = null;
            });
        }

        return view('client.dashboard', compact('creators', 'categories'));
    }

    public function showCreator($id)
    {
        $creator = User::role('creator')->with(['profile.categories', 'mediaUploads'])->findOrFail($id);
        return view('client.creator-show', compact('creator'));
    }

    public function profile()
    {
        $user = auth()->user();
        $profile = $user->profile()->firstOrCreate([]);
        $mediaUploads = $user->mediaUploads()->latest()->get();
        return view('client.profile', compact('user', 'profile', 'mediaUploads'));
    }

    public function editProfile()
    {
        $user = auth()->user();
        $profile = $user->profile()->firstOrCreate([]);
        return view('client.profile-edit', compact('user', 'profile'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'bio' => 'nullable|string',
            'city' => 'nullable|string|max:255',
        ]);

        $profile = auth()->user()->profile()->firstOrCreate([]);
        $data = $request->only('bio', 'city');

        if ($request->hasFile('avatar')) {
            if ($profile->avatar) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($profile->avatar);
            }
            $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        $profile->update($data);

        return redirect()->route('client.profile')->with('status', 'Profil client berhasil diperbarui!');
    }

    public function collaborations()
    {
        $endorsements = auth()->user()->clientEndorsements()->with(['creator.profile'])->latest()->get();
        return view('client.collaborations', compact('endorsements'));
    }
}
