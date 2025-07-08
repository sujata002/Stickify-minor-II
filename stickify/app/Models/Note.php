<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Note extends Model
{
    // fields that can be safely filled automatically when creating or updating afno record or notes
    protected $fillable = [
        'note_text',
        'url',
        'user_id',
    ];

    // note ra user ko realtionship
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
