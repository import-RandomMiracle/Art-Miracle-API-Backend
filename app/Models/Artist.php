<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    use HasFactory;

    protected $fillable = [
        'citizen_id',
        'real_name',
        'address',
    ];

    public function user(){
        return $this->hasOne(User::class);
    }

    public function artworks(){
        return $this->hasManyThrough(Artwork::class, Artist::class, 'artist_id', 'artwork_id', 'id', 'id');
    }

}
