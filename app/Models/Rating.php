<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = [
        'endorsement_id',
        'reviewer_id',
        'reviewee_id',
        'score',
        'comment',
    ];

    public function endorsement()
    {
        return $this->belongsTo(Endorsement::class);
    }
}
