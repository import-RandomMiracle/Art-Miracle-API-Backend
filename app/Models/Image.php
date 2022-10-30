<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    public function user(){
        return $this->hasOne(User::class);
    }

    public function artwork(){
        return $this->hasOne(Artwork::class);
    }
}
