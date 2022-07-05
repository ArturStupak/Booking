<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Check extends Model
{
    use HasFactory;
    public function atributes()
    {
        return $this->hasOne(Atributes::class, 'id', 'atributes_id');
    }
    public function checks()
    {
        return $this->hasOne(Place::class, 'id', 'places_id');
    }
}
