<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    use HasFactory;

    public function user(){
        return $this->hasOne(User::class);
    }

    public function artworks(){
        return $this->hasMany(Artwork::class);
    }

}
