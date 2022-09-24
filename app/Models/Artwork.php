<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artwork extends Model
{
    use HasFactory;

    public function users() {
        return $this->belongsToMany(User::class);
    }

    public function likes() {
        return $this->hasMany(Like::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function tags(){
        return $this->belongsToMany(Categoty::class);
    }

    public function categories(){
        return $this->belongsToMany(Categoty::class);
    }

    public function reports()
    {
        return $this->morphMany(Report::class, 'reportable');
    }
}
