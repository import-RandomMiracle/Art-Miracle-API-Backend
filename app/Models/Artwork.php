<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artwork extends Model
{
    use HasFactory;

    protected $fillable = [
        'art_name',
        'artist_id',
        'price',
        'path',
        'description',
        'categories',
        'tags',
    ];

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
        return $this->belongsToMany(Tag::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function reports()
    {
        return $this->morphMany(Report::class, 'reportable');
    }

    public function artist(){
        return $this->belongsTo(Artist::class);
    }

    public function image(){
        return $this->belongsTo(Image::class);
    }
}
