<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'status',
        'note',
        'imdb_id',
        'poster_url',
    ];

    public function user() 
    {
       return $this->belongsTo(User::class);
    }
}
