<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DynamicBackground extends Model
{
    protected $fillable = ['type', 'content', 'is_active'];

    public function getContentUrlAttribute()
    {
        if ($this->type === 'image') {
            if ($this->content && \Illuminate\Support\Facades\Storage::disk('public')->exists($this->content)) {
                return asset('storage/' . $this->content);
            }
            return 'https://placehold.co/1920x1080?text=Background+Not+Found';
        }
        return $this->content;
    }
}
