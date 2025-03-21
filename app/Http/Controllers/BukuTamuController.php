<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BukuTamu;
use Carbon\Carbon;

class BukuTamuController extends Controller
{
    /**
     * Menampilkan daftar tamu.
     */
    // Menampilkan daftar tamu (untuk admin)
    public function index()
    {
        $bukuTamus = BukuTamu::latest()->get();
        return view('admin.dashboard', compact('bukuTamus'));
    }


    /**
     * Menampilkan form untuk menambah tamu baru.
     */
    public function create()
    {
        $statistik = [
            'hari_ini' => BukuTamu::whereDate('created_at', Carbon::today())->count(),
            'kemarin' => BukuTamu::whereDate('created_at', Carbon::yesterday())->count(),
            'bulan_ini' => BukuTamu::whereMonth('created_at', Carbon::now()->month)->count(),
            'total' => BukuTamu::count()
        ];

        return view('bukutamu.create', compact('statistik'));
    }

    /**
     * Menyimpan data tamu ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'instansi' => 'nullable|string|max:255',
            'keperluan' => 'required|string',
            'nomor_telepon' => 'nullable|numeric|digits_between:10,15'
        ]);

        BukuTamu::create($request->all());

        return redirect()->route('buku-tamus.create')->with('success', 'Data tamu berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail tamu.
     */
    public function show(BukuTamu $bukuTamu)
    {
        return view('bukutamu.show', compact('bukuTamu'));
    }

    /**
     * Menampilkan form untuk mengedit tamu.
     */
    public function edit(BukuTamu $bukuTamu)
    {
        return view('bukutamu.edit', compact('bukuTamu'));
    }

    /**
     * Mengupdate data tamu.
     */
    public function update(Request $request, BukuTamu $bukuTamu)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'instansi' => 'nullable|string|max:255',
            'keperluan' => 'required|string',
            'nomor_telepon' => 'nullable|numeric|digits_between:10,15',
            'tanggal' => 'required|date',
        ]);

        $bukuTamu->update($request->all());

        return redirect()->route('buku-tamus.index')->with('success', 'Data tamu berhasil diperbarui.');
    }

    /**
     * Menghapus tamu dari database.
     */
    public function destroy(BukuTamu $bukuTamu)
    {
        $bukuTamu->delete();
        return redirect()->route('buku-tamus.index')->with('success', 'Data tamu berhasil dihapus.');
    }
}
