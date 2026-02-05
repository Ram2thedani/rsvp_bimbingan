<?php

namespace App\Http\Controllers;

use App\Models\Sesi;
use App\Models\Siswa;
use App\Models\Kehadiran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $sesiList = Sesi::orderBy('tanggal')
            ->get()
            ->map(function ($sesi) {
                $sesi->jumlah_hadir = DB::table('kehadirans')
                    ->where('id_sesi', $sesi->id)
                    ->where('hadir', 1)
                    ->count();

                return $sesi;
            });

        return view('dashboard.kehadiran', compact('sesiList'));
    }
    public function detail(Sesi $sesi)
    {
        // Ambil semua siswa
        $siswa = Siswa::with('kelas')
            ->orderBy('nama')
            ->get();

        // Ambil kehadiran sesi ini, key by id_siswa
        $kehadiran = Kehadiran::where('id_sesi', $sesi->id)
            ->get()
            ->keyBy('id_siswa');

        return view('dashboard.detail-sesi', compact(
            'sesi',
            'siswa',
            'kehadiran'
        ));
    }
}
