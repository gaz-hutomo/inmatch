<?php

namespace App\Http\Controllers;

use App\Models\Endorsement;
use Illuminate\Http\Request;

class EndorsementController extends Controller
{
    public function updateStatus(Request $request, Endorsement $endorsement)
    {
        $request->validate([
            'status' => 'required|in:accepted,rejected,completed',
        ]);

        // Ensure the logged-in creator owns this project/endorsement
        if ($endorsement->influencer_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $endorsement->update(['status' => $request->status]);

        return back()->with('status', 'Status proyek berhasil diperbarui!');
    }

    public function store(Request $request)
    {
        $creatorId = $request->input('creator_id', $request->input('influencer_id'));

        $request->merge(['creator_id' => $creatorId]);
        $request->validate([
            'creator_id' => 'required|exists:users,id',
            'offered_price' => 'required|numeric|min:0',
            'description' => 'required|string',
        ]);

        Endorsement::create([
            'vendor_id' => auth()->id(),
            'influencer_id' => $creatorId,
            'offered_price' => $request->offered_price,
            'description' => $request->description,
            'status' => 'pending',
        ]);

        return back()->with('status', 'Tawaran proyek berhasil dikirim! Menunggu konfirmasi Penyedia Jasa.');
    }
}
