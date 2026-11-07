<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MediaUpload extends Model
{
    protected $fillable = [
        'user_id',
        'file_path',
        'file_type',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getFileUrlAttribute()
    {
        if ($this->file_path && \Illuminate\Support\Facades\Storage::disk('public')->exists($this->file_path)) {
            return asset('storage/' . $this->file_path);
        }
        return 'https://placehold.co/600x400?text=Image+Not+Found';
    }
}
