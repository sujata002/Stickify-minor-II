<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Note;
use App\Models\ExtensionToken;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'verification_token',     // for extension token generation..... this is just copied from dg-work ko user.php bata yo line matra
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // user can have multiple notes so 
    public function notes()
    {
        return $this->hasMany(Note::class);
    }
}
