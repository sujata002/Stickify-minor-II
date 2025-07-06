<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Note extends Model
{
    public function user(){
        return $this->belogsTo(User::class);
    }
}
