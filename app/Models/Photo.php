<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Photo extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'people_id',
        'name_photos'
    ];

    public $timestamps = false;

    public function name()
    {
        return $this->belongsTo(People::class);
    }
}
