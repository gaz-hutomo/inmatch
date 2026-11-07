<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Endorsement extends Model
{
    protected $fillable = [
        'vendor_id',
        'influencer_id',
        'description',
        'offered_price',
        'status',
        'vendor_completed_at',
        'influencer_completed_at',
    ];

    public function vendor()
    {
        return $this->belongsTo(User::class, 'vendor_id');
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'vendor_id');
    }

    public function influencer()
    {
        return $this->belongsTo(User::class, 'influencer_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'influencer_id');
    }

    public function chats()
    {
        return $this->hasMany(ChatMessage::class);
    }

    public function rating()
    {
        return $this->hasOne(Rating::class);
    }
}
