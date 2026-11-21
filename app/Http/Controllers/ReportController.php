<?php

namespace App\Http\Controllers;

use App\Models\Endorsement;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function store(Request $request, Endorsement $endorsement)
    {
        $userId = Auth::id();
        
        // Ensure only project participants can report
        if ($endorsement->vendor_id !== $userId && $endorsement->influencer_id !== $userId) {
            abort(403, 'Anda bukan partisipan dalam proyek ini.');
        }

        $request->validate([
            'reason' => 'required|string|max:100',
            'description' => 'required|string|max:2000',
            'proof_file' => 'nullable|file|mimes:jpeg,png,jpg,pdf,mp4|max:5120',
        ]);

        $reportedId = ($endorsement->vendor_id === $userId) 
            ? $endorsement->influencer_id 
            : $endorsement->vendor_id;

        $proofPath = null;
        if ($request->hasFile('proof_file')) {
            $proofPath = $request->file('proof_file')->store('reports', 'public');
        }

        Report::create([
            'reporter_id' => $userId,
            'reported_id' => $reportedId,
            'endorsement_id' => $endorsement->id,
            'reason' => $request->reason,
            'description' => $request->description,
            'proof_path' => $proofPath,
            'status' => 'pending',
        ]);

        return back()->with('status', 'Laporan masalah berhasil dikirimkan ke Admin dan akan segera ditinjau.');
    }
}
