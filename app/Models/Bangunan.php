<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bangunan extends Model
{
    use HasFactory;

    public function penghuni() {
        $this->hasMany(Penduduk::class, 'rumah_id', 'id');
    }

}
