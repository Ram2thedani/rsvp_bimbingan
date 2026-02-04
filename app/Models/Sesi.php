<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Sesi extends Model
{
    protected $guarded = ['id'];

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

    // ✅ cek token masih valid atau tidak
    public function getIsTokenValidAttribute()
    {
        return Carbon::today()->lt(Carbon::parse($this->tanggal));
    }

    public function isTokenValid(): bool
    {
        return Carbon::today()->lt(Carbon::parse($this->tanggal));
    }
}
