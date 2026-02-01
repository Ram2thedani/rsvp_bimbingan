<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $guarded = [
        'id'
    ];

    public function Kehadiran()
    {
        return $this->hasMany(Kehadiran::class, 'id_kelas', 'id');
    }
    public function Siswa()
    {
        return $this->hasMany(Siswa::class, 'id_kelas', 'id');
    }
}
