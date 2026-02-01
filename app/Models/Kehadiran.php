<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kehadiran extends Model
{
    protected $guarded = [
        'id'
    ];


    public function Siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa', 'id');
    }

    public function Kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id');
    }

    public function Sesi()
    {
        return $this->belongsTo(Sesi::class, 'id_sesi', 'id');
    }
}
