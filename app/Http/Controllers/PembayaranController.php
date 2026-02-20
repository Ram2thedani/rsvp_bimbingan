<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Siswa;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private const HARDCOVER_PRICE = 35000;

    public function index()
    {
        $siswas = Siswa::with('pembayarans')->get();

        $data = $siswas->map(function ($siswa) {
            $totalBayar = $siswa->pembayarans->sum('nominal_bayar');
            $sisa = self::HARDCOVER_PRICE - $totalBayar;

            return [
                'id' => $siswa->id,
                'nama' => $siswa->nama,
                'total_tagihan' => self::HARDCOVER_PRICE,
                'total_bayar' => $totalBayar,
                'sisa' => $sisa,
                'status' => $sisa <= 0 ? 'Lunas' : 'Belum Lunas'
            ];
        });

        return view('pembayaran.index', compact('data'));
    }

    public function bayar($id)
    {
        $siswa = Siswa::findOrFail($id);

        $totalBayar = Pembayaran::where('id_siswa', $id)
            ->sum('nominal_bayar');

        $sisa = self::HARDCOVER_PRICE - $totalBayar;

        return view('pembayaran.bayar', compact(
            'siswa',
            'totalBayar',
            'sisa'
        ));
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
        $request->validate([
            'id_siswa' => 'required|exists:siswas,id',
            'nominal_bayar' => 'required|numeric|min:1',
            'tanggal_bayar' => 'required|date'
        ]);

        $totalBayar = Pembayaran::where('id_siswa', $request->id_siswa)
            ->sum('nominal_bayar');

        $sisa = self::HARDCOVER_PRICE - $totalBayar;

        if ($request->nominal_bayar > $sisa) {
            return back()->with('error', 'Pembayaran melebihi sisa tagihan.');
        }

        Pembayaran::create([
            'id_siswa' => $request->id_siswa,
            'nominal_bayar' => $request->nominal_bayar,
            'tanggal_bayar' => $request->tanggal_bayar,
        ]);

        return redirect()
            ->route('pembayaran.index')
            ->with('success', 'Pembayaran berhasil ditambahkan.');
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
