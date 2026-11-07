<?php

namespace App\Http\Controllers;

use App\Models\MediaUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'media' => 'required|file|mimes:jpg,jpeg,png,mp4|max:10240', // max 10MB
        ]);

        $file = $request->file('media');
        $path = $file->store('media', 'public');
        $type = str_contains($file->getMimeType(), 'video') ? 'video' : 'image';

        MediaUpload::create([
            'user_id' => auth()->id(),
            'file_path' => $path,
            'file_type' => $type,
        ]);

        return back()->with('status', 'Media berhasil diunggah!');
    }

    public function destroy(MediaUpload $mediaUpload)
    {
        if ($mediaUpload->user_id !== auth()->id()) {
            abort(403);
        }

        Storage::disk('public')->delete($mediaUpload->file_path);
        $mediaUpload->delete();

        return back()->with('status', 'Media berhasil dihapus!');
    }
}
