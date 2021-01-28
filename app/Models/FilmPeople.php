<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FilmPeople extends Model
{
    use HasFactory;

    protected $fillable = [
        'people_id',
        'film_id'
    ];

    public $timestamps = false;
}
