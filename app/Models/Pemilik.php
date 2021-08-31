<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemilik extends Model
{
    use HasFactory;

    public function rumah() {
        $this->hasMany(Rumah::class, 'pemilik_id', 'id');
    }
}
