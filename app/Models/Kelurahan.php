<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelurahan extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    public function user() {
        return $this->hasMany(User::class, 'kelurahan_id', 'id');
    }

    public function lurah() {
        return $this->belongsTo(PerangkatKelurahan::class, 'lurah_id', 'id');
    }

    public function sekretaris() {
        return $this->belongsto(PerangkatKelurahan::class, 'sekretaris_id', 'id');
    }
}
