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
        $expiredAt = Carbon::parse($this->tanggal)->setTime(07, 0, 0);
        return now()->lt($expiredAt);
    }

    public function isTokenValid(): bool
    {
        $expiredAt = Carbon::parse($this->tanggal)->setTime(07, 0, 0);
        return now()->lt($expiredAt);
    }
}
