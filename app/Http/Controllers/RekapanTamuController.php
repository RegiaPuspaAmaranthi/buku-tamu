<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RekapanTamu;
use App\Models\BukuTamu;
use App\Models\BiodataTamu;

class RekapanTamuController extends Controller
{
    /**
     * Menampilkan daftar rekapan tamu.
     */
    public function index()
    {
        $rekapanTamus = RekapanTamu::with(['bukuTamu', 'biodataTamu'])->get();
        return view('rekapan_tamus.index', compact('rekapanTamus'));
    }

    /**
     * Menampilkan form untuk menambah rekapan tamu baru.
     */
    public function create()
    {
        $bukuTamus = BukuTamu::all();
        $biodataTamus = BiodataTamu::all();
        return view('rekapan_tamus.create', compact('bukuTamus', 'biodataTamus'));
    }

    /**
     * Menyimpan data rekapan tamu ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'buku_tamu_id' => 'required|exists:buku_tamus,id',
            'biodata_tamu_id' => 'required|exists:biodata_tamus,id',
            'tanggal_kunjungan' => 'required|date',
            'status' => 'required|in:Belum Selesai,Proses,Selesai',
        ]);

        RekapanTamu::create($request->all());

        return redirect()->route('rekapan-tamus.index')->with('success', 'Rekapan tamu berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail rekapan tamu.
     */
    public function show(RekapanTamu $rekapanTamu)
    {
        return view('rekapan_tamus.show', compact('rekapanTamu'));
    }

    /**
     * Menampilkan form untuk mengedit rekapan tamu.
     */
    public function edit(RekapanTamu $rekapanTamu)
    {
        $bukuTamus = BukuTamu::all();
        $biodataTamus = BiodataTamu::all();
        return view('rekapan_tamus.edit', compact('rekapanTamu', 'bukuTamus', 'biodataTamus'));
    }

    /**
     * Mengupdate data rekapan tamu.
     */
    public function update(Request $request, RekapanTamu $rekapanTamu)
    {
        $request->validate([
            'buku_tamu_id' => 'required|exists:buku_tamus,id',
            'biodata_tamu_id' => 'required|exists:biodata_tamus,id',
            'tanggal_kunjungan' => 'required|date',
            'status' => 'required|in:Belum Selesai,Proses,Selesai',
        ]);

        $rekapanTamu->update($request->all());

        return redirect()->route('rekapan-tamus.index')->with('success', 'Rekapan tamu berhasil diperbarui.');
    }

    /**
     * Menghapus rekapan tamu dari database.
     */
    public function destroy(RekapanTamu $rekapanTamu)
    {
        $rekapanTamu->delete();
        return redirect()->route('rekapan-tamus.index')->with('success', 'Rekapan tamu berhasil dihapus.');
    }
}
