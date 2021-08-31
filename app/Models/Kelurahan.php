<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelurahan extends Model
{
    use HasFactory;

    public function user() {
        return $this->hasMany(User::class, 'kelurahan_id', 'id');
    }

    public function lurah() {
        return $this->belongsTo(Penduduk::class, 'lurah_id', 'id');
    }

    public function sekretaris() {
        return $this->belongsto(Penduduk::class, 'sekretaris_id', 'id');
    }
}
