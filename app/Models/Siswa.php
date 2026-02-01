<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $guarded = [
        'id'
    ];

    public function Kehadiran()
    {
        return $this->hasMany(Kehadiran::class, 'id_siswa', 'id');
    }

    public function Kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id');
    }
}
