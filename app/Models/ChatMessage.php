<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    protected $fillable = [
        'endorsement_id',
        'sender_id',
        'message',
        'attachment_path',
        'attachment_type',
        'is_system',
    ];

    public function endorsement()
    {
        return $this->belongsTo(Endorsement::class);
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
}
