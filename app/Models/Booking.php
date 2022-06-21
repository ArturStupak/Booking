<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    public function wishes()
    {
        return $this->hasMany(Wishes::class, 'booking_id', 'id');
    }
}
