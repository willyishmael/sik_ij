<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penduduk extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    public function bangunan() {
        return $this->belongsTo(Bangunan::class, 'bangunan_id', 'id');
    }

    public function kelurahan() {
        return $this->belongsTo(Kelurahan::class, 'kelurahan_id', 'id');
    }

}
