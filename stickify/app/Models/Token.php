<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Token extends Model
{// fillable rakhena bhanni laravel would reject create call as yesma chai kun field chai 
    // create and update bata fill huncha bhancha 
    protected $fillable = ['token'];

    public function user(){
        return $this->belongsTo(\App\Models\User::class);
    }

    public function notes()
    {// token ra notes ko relationship define garch as euta token ko multiple notes huncha 
        return $this->hasMany(Note::class);// allows 
    }
}