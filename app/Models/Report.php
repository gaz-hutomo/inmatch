<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'reporter_id',
        'reported_id',
        'endorsement_id',
        'reason',
        'description',
        'proof_path',
        'status',
    ];

    public function reporter()
    {
        return $this->belongsTo(User::class, 'reporter_id');
    }

    public function reported()
    {
        return $this->belongsTo(User::class, 'reported_id');
    }

    public function endorsement()
    {
        return $this->belongsTo(Endorsement::class, 'endorsement_id');
    }

    public function getProofUrlAttribute()
    {
        if ($this->proof_path && \Illuminate\Support\Facades\Storage::disk('public')->exists($this->proof_path)) {
            return asset('storage/' . $this->proof_path);
        }
        return null;
    }
}
