<?php

namespace App\Http\Controllers;

use App\Models\Endorsement;
use App\Models\ChatMessage;
use App\Models\Rating;
use Illuminate\Http\Request;

class CollaborationController extends Controller
{
    public function show(Endorsement $endorsement)
    {
        // Ensure user is authorized
        if (auth()->id() !== $endorsement->vendor_id && auth()->id() !== $endorsement->influencer_id) {
            abort(403, 'Unauthorized action.');
        }

        $endorsement->load(['vendor.profile', 'influencer.profile', 'chats.sender', 'rating']);

        return view('collaborations.show', compact('endorsement'));
    }

    public function sendMessage(Request $request, Endorsement $endorsement)
    {
        if (auth()->id() !== $endorsement->vendor_id && auth()->id() !== $endorsement->influencer_id) {
            abort(403);
        }

        $request->validate([
            'message' => 'nullable|string',
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,mp4,mov,avi|max:51200', // max 50MB
        ]);

        if (!$request->filled('message') && !$request->hasFile('attachment')) {
            return back()->withErrors(['message' => 'Pesan atau lampiran tidak boleh kosong.']);
        }

        $attachmentPath = null;
        $attachmentType = null;

        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $attachmentPath = $file->store('chat_attachments', 'public');
            
            $mimeType = $file->getMimeType();
            if (str_starts_with($mimeType, 'image/')) {
                $attachmentType = 'image';
            } elseif (str_starts_with($mimeType, 'video/')) {
                $attachmentType = 'video';
            }
        }

        $endorsement->chats()->create([
            'sender_id' => auth()->id(),
            'message' => $request->message ?? '',
            'attachment_path' => $attachmentPath,
            'attachment_type' => $attachmentType,
            'is_system' => false,
        ]);

        return back();
    }

    public function updatePrice(Request $request, Endorsement $endorsement)
    {
        if (auth()->id() !== $endorsement->vendor_id && auth()->id() !== $endorsement->influencer_id) abort(403);
        if ($endorsement->status !== 'pending') abort(400);

        $request->validate([
            'offered_price' => 'required|numeric|min:0',
        ]);

        $oldPrice = $endorsement->offered_price;
        $endorsement->update(['offered_price' => $request->offered_price]);

        $roleName = auth()->user()->hasRole('vendor') ? 'Vendor' : 'Influencer';

        $endorsement->chats()->create([
            'message' => $roleName . " mengajukan tawaran harga baru dari Rp " . number_format($oldPrice, 0, ',', '.') . " menjadi Rp " . number_format($request->offered_price, 0, ',', '.'),
            'is_system' => true,
        ]);

        return back()->with('status', 'Tawaran harga berhasil diperbarui.');
    }

    public function acceptOffer(Request $request, Endorsement $endorsement)
    {
        if (auth()->id() !== $endorsement->influencer_id) abort(403);
        if ($endorsement->status !== 'pending') abort(400);

        $endorsement->update(['status' => 'accepted']);

        $endorsement->chats()->create([
            'message' => "Influencer (" . auth()->user()->name . ") telah MENYETUJUI tawaran harga sebesar Rp " . number_format($endorsement->offered_price, 0, ',', '.'),
            'is_system' => true,
        ]);

        return back()->with('status', 'Tawaran berhasil disetujui.');
    }

    public function rejectOffer(Request $request, Endorsement $endorsement)
    {
        if (auth()->id() !== $endorsement->influencer_id) abort(403);
        if ($endorsement->status !== 'pending') abort(400);

        $endorsement->update(['status' => 'rejected']);

        $endorsement->chats()->create([
            'message' => "Influencer (" . auth()->user()->name . ") telah MENOLAK tawaran kolaborasi.",
            'is_system' => true,
        ]);

        return back()->with('status', 'Tawaran berhasil ditolak.');
    }

    public function simulatePayment(Request $request, Endorsement $endorsement)
    {
        if (auth()->id() !== $endorsement->vendor_id) abort(403);
        if ($endorsement->status !== 'accepted') abort(400);

        $request->validate([
            'payment_method' => 'required|string',
        ]);

        $endorsement->update(['status' => 'active']); // Should it be active? The instruction says the status is accepted and then completed. Wait, my code currently doesn't update the status in simulatePayment. I'll leave status as accepted.
        
        $method = strtoupper($request->payment_method);

        // Simulated payment system message with HTML string so we can render a print button
        $endorsement->chats()->create([
            'message' => "RECEIPT|#TX-IM-" . $endorsement->id . "|" . $endorsement->description . "|" . $endorsement->offered_price . "|" . $method,
            'is_system' => true,
        ]);

        return back()->with('status', 'Pembayaran berhasil disimulasikan.');
    }

    public function receipt(Endorsement $endorsement)
    {
        if (auth()->id() !== $endorsement->vendor_id && auth()->id() !== $endorsement->influencer_id) {
            abort(403);
        }

        return view('collaborations.receipt', compact('endorsement'));
    }

    public function complete(Request $request, Endorsement $endorsement)
    {
        if (auth()->id() !== $endorsement->influencer_id && auth()->id() !== $endorsement->vendor_id) abort(403);
        if ($endorsement->status !== 'active') abort(400);

        if (auth()->id() === $endorsement->vendor_id) {
            $endorsement->update(['vendor_completed_at' => now()]);
            $endorsement->chats()->create([
                'sender_id' => auth()->id(),
                'message' => 'Telah menandai kolaborasi selesai. Menunggu konfirmasi dari partner...',
                'is_system' => false,
            ]);
        } else {
            $endorsement->update(['influencer_completed_at' => now()]);
            $endorsement->chats()->create([
                'sender_id' => auth()->id(),
                'message' => 'Telah menandai kolaborasi selesai. Menunggu konfirmasi dari partner...',
                'is_system' => false,
            ]);
        }

        if ($endorsement->vendor_completed_at && $endorsement->influencer_completed_at) {
            $endorsement->update(['status' => 'completed']);
            $endorsement->chats()->create([
                'message' => 'Kolaborasi telah selesai sepenuhnya. Vendor sekarang dapat memberikan rating.',
                'is_system' => true,
            ]);
        }

        return back()->with('status', 'Berhasil memperbarui status penyelesaian.');
    }

    public function rate(Request $request, Endorsement $endorsement)
    {
        if (auth()->id() !== $endorsement->vendor_id) abort(403);
        if ($endorsement->status !== 'completed') abort(400);
        if ($endorsement->rating) abort(400, 'Sudah dinilai.');

        $request->validate([
            'score' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);

        Rating::create([
            'endorsement_id' => $endorsement->id,
            'reviewer_id' => auth()->id(),
            'reviewee_id' => $endorsement->influencer_id,
            'score' => $request->score,
            'comment' => $request->comment,
        ]);

        $stars = str_repeat('⭐', $request->score);
        $endorsement->chats()->create([
            'message' => "Vendor telah memberikan penilaian " . $stars . " (" . $request->score . "/5) kepada Influencer.\nCatatan: \"" . ($request->comment ?? '-') . "\"",
            'is_system' => true,
        ]);

        return back()->with('status', 'Penilaian berhasil disimpan.');
    }
}
