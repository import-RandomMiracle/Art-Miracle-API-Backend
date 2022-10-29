<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    use HasFactory;

    public function followee(){
        return $this->belongsTo(User::class);
    }

    public function follower(){
        return $this->belongsTo(User::class);
    }
}
