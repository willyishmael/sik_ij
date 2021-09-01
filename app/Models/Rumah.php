<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rumah extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    public function penghuni() {
        $this->hasMany(Penduduk::class, 'rumah_id', 'id');
    }

    public function pemilik() {
        $this->belongsTo(Pemilik::class, 'pemilik_id', 'id');
    }
}
