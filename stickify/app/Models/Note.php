<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Testing\Fluent\Concerns\Has;

class Note extends Model
{
    use HasFactory;
    use SoftDeletes;
    // fields that can be safely filled automatically when creating or updating afno record or notes
    protected $fillable = [
    'title',
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
