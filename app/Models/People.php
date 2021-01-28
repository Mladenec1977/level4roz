<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class People extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'name',
        'height',
        'mass',
        'hair_color',
        'birth_year',
        'created',
        'gender_id',
        'homeworld_id'
    ];

    public function gender()
    {
        return $this->belongsTo(Gender::class);
    }

    public function homeworld()
    {
        return $this->belongsTo(Homeworld::class);
    }
    public function rolesFilm()
    {
        return $this->belongsToMany(Film::class);
    }
    public function rolesPhoto()
    {
        return $this->hasMany(Photo::class);
    }
}
