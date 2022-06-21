<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    use HasFactory;

    public function relationship()
    {
        return $this->hasOne(Gallery::class, 'place_id', 'id');
    }
    public function city()
    {
        return $this->hasOne(City::class, 'id', 'city_id');
    }


}
