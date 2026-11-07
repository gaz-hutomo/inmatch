<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'user_id',
        'avatar',
        'bio',
        'city',
        'latitude',
        'longitude',
        'min_price',
        'max_price',
        'primary_category_id',
        'secondary_category_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_profile');
    }

    public function primaryCategory()
    {
        return $this->belongsTo(Category::class, 'primary_category_id');
    }

    public function secondaryCategory()
    {
        return $this->belongsTo(Category::class, 'secondary_category_id');
    }

    public function getAvatarUrlAttribute()
    {
        if ($this->avatar && \Illuminate\Support\Facades\Storage::disk('public')->exists($this->avatar)) {
            return asset('storage/' . $this->avatar);
        }
        
        $name = urlencode($this->user ? $this->user->name : 'User');
        return 'https://ui-avatars.com/api/?name=' . $name . '&background=random';
    }
}
