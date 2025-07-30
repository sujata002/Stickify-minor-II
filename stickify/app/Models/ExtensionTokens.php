<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class ExtensionTokens extends Model
{
    // hamro table create extension wala use garcha instead of any other default table that laravel expects
    protected $table = 'extensions_tokens';

    // just yeti field chai can be automatically filled while creating or updating 
    protected $fillable = [
        'user_id',
        'token',
        'expires_at',
        'is_used',
    ];
    
    protected $casts=[
        'expires_at'=>'datetime',
        'is_used'=>'boolean',
    ];

    // Extension Token belongs to  user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
