<?php

namespace App\Http\Controllers;

use App\Models\Kehadiran;
use App\Models\Sesi;
use App\Models\Siswa;
use Illuminate\Http\Request;

class RsvpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($token)
    {
        $sesi = Sesi::where('token', $token)->firstOrFail();
        $siswa = Siswa::orderBy('nama')->get();

        return view('kehadiran.rsvp', compact('sesi', 'siswa'));
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_siswa' => 'required',
            'id_kelas' => 'required',
            'id_sesi' => 'required',
            'hadir' => 'required',
        ]);

        // Cegah RSVP ganda
        $exists = Kehadiran::where('id_siswa', $request->id_siswa)
            ->where('id_sesi', $request->id_sesi)
            ->exists();

        if ($exists) {
            return back()->with('error', 'Anda sudah mengisi RSVP untuk sesi ini.');
        }

        Kehadiran::create([
            'id_siswa' => $request->id_siswa,
            'id_kelas' => $request->id_kelas,
            'id_sesi'  => $request->id_sesi,
            'hadir'    => $request->hadir,
            'keterangan' => $request->hadir == 1
                ? 'Hadir'
                : $request->keterangan,
        ]);

        return redirect()->back()->with('success', 'RSVP berhasil dikirim.');
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
