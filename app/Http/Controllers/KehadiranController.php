<?php

namespace App\Http\Controllers;

use App\Models\Kehadiran;
use App\Models\Sesi;
use App\Models\Siswa;
use Illuminate\Http\Request;

class KehadiranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // 1. Ambil list sesi untuk dropdown (tetap di sini tidak masalah)
        $sesiList = Sesi::orderBy('tanggal')->get();

        // 2. Tentukan $tanggal TERLEBIH DAHULU
        $tanggal = $request->tanggal;

        if (!$tanggal) {
            // Jika tidak ada di request, ambil tanggal sesi pertama
            $tanggal = Sesi::orderBy('tanggal')->first()?->tanggal;
        }

        // 3. Baru jalankan query Siswa dengan $tanggal yang sudah pasti ada isinya
        $siswa = Siswa::with(['kelas', 'kehadiran' => function ($q) use ($tanggal) {
            // Pastikan relasi 'sesi' dan kolom 'tanggal' sesuai dengan database Anda
            $q->whereHas('sesi', function ($qs) use ($tanggal) {
                $qs->where('tanggal', $tanggal);
            });
        }])->get();

        return view('kehadiran.index', compact('siswa', 'tanggal', 'sesiList'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $kehadiran = Kehadiran::findOrFail($id);

        $kehadiran->hadir = $request->has('hadir') ? 1 : 0;
        $kehadiran->save();

        return back();
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function storeOrUpdate(Request $request)
    {
        $sesi = Sesi::firstOrCreate([
            'tanggal' => $request->tanggal
        ]);

        $siswa = Siswa::findOrFail($request->id_siswa);

        $hadir = $request->has('hadir') ? 1 : 0;

        Kehadiran::updateOrCreate(
            [
                'id_siswa' => $siswa->id,
                'id_sesi'  => $sesi->id,
            ],
            [
                'id_kelas'   => $siswa->id_kelas,
                'hadir'      => $hadir,
                'keterangan' => $hadir ? 'Hadir (konfirmasi hari-H)' : 'Tidak hadir',
            ]
        );

        return back();
    }
    public function detail($id)
    {
        $kehadiran = Kehadiran::find($id);
        return view('kehadiran.detail', compact('kehadiran'));
    }
}
