<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Note;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['name', 'email', 'password'];

    protected $hidden = ['password', 'remember_token'];

    //euta user ko dherai note huncha 
    public function notes()
    {
        return $this->hasMany(Note::class);
    }

   // euta user ko differen interval ma different token huncha 
    public function extensionTokens()
    {
        return $this->hasMany(ExtensionToken::class);
    }
}
