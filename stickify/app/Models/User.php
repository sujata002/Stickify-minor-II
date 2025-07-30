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
        'token', // for extension token generation
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

    public function extensionTokens(){
        return $this->hasOne(ExtensionTokens::class);
    }
}
