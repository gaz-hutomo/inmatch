<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name'];

    public function profiles()
    {
        return $this->belongsToMany(Profile::class, 'category_profile');
    }

    public function primaryProfiles()
    {
        return $this->hasMany(Profile::class, 'primary_category_id');
    }

    public function secondaryProfiles()
    {
        return $this->hasMany(Profile::class, 'secondary_category_id');
    }
}
