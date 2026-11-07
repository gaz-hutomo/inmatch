<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
    ];

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function mediaUploads()
    {
        return $this->hasMany(MediaUpload::class);
    }

    public function vendorEndorsements()
    {
        return $this->hasMany(Endorsement::class, 'vendor_id');
    }

    public function clientEndorsements()
    {
        return $this->hasMany(Endorsement::class, 'vendor_id');
    }

    public function influencerEndorsements()
    {
        return $this->hasMany(Endorsement::class, 'influencer_id');
    }

    public function creatorEndorsements()
    {
        return $this->hasMany(Endorsement::class, 'influencer_id');
    }

    public function ratingsReceived()
    {
        return $this->hasMany(Rating::class, 'reviewee_id');
    }



    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
