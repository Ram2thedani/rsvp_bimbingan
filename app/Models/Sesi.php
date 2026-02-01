<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Sesi extends Model
{
    protected $guarded = [
        'id'
    ];
    public function Kehadiran()
    {
        return $this->hasMany(Kehadiran::class, 'id_sesi', 'id');
    }

    protected static function booted()
    {
        static::creating(function ($sesi) {
            if (empty($sesi->token)) {
                $sesi->token = Str::random(32);
            }
        });
    }
}
