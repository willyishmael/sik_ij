<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penduduk extends Model
{
    use HasFactory;

    public function rumah() {
        return $this->belongsTo(Rumah::class, 'rumah_id', 'id');
    }

    public function kepalaKeluarga() {
        return $this->belongsTo(Penduduk::class, 'kepala_keluarga_id', 'id');
    }

}
