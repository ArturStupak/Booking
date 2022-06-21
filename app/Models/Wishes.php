<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishes extends Model
{
    use HasFactory;

    public function atributes()
    {
        return $this->hasOne(Atributes::class, 'id', 'atributes_id');
    }
}
