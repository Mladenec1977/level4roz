<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Homeworld extends Model
{
    use HasFactory;

    public function rolesPeople()
    {
        return $this->hasMany(People::class);
    }
}
