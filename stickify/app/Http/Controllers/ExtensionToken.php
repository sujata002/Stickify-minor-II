<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExtensionToken extends Model
{
    protected $fillable = ['token', 'user_id', /* other fields */];
}

// ExtensionToken banako because it represents the token generated for the user, which is stored in the database.