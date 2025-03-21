<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BiodataTamu;
use App\Models\BukuTamu;

class BiodataTamuController extends Controller
{
    /**
     * Menampilkan daftar biodata tamu.
     */
    public function index()
    {
        $biodataTamus = BiodataTamu::with('bukuTamu')->get();
        return view('biodata_tamus.index', compact('biodataTamus'));
    }

    /**
     * Menampilkan form untuk menambah biodata tamu.
     */
    public function create()
    {
        $bukuTamus = BukuTamu::all();
        return view('biodata_tamus.create', compact('bukuTamus'));
    }

    /**
     * Menyimpan data biodata tamu ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'buku_tamu_id' => 'required|exists:buku_tamus,id',
            'permasalahan' => 'nullable|string',
            'tanggapan' => 'nullable|string',
            'status' => 'required|in:Belum Selesai,Proses,Selesai',
        ]);

        BiodataTamu::create($request->all());

        return redirect()->route('biodata-tamus.index')->with('success', 'Biodata tamu berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail biodata tamu.
     */
    public function show(BiodataTamu $biodataTamu)
    {
        return view('biodata_tamus.show', compact('biodataTamu'));
    }

    /**
     * Menampilkan form untuk mengedit biodata tamu.
     */
    public function edit(BiodataTamu $biodataTamu)
    {
        $bukuTamus = BukuTamu::all();
        return view('biodata_tamus.edit', compact('biodataTamu', 'bukuTamus'));
    }

    /**
     * Mengupdate data biodata tamu.
     */
    public function update(Request $request, BiodataTamu $biodataTamu)
    {
        $request->validate([
            'buku_tamu_id' => 'required|exists:buku_tamus,id',
            'permasalahan' => 'nullable|string',
            'tanggapan' => 'nullable|string',
            'status' => 'required|in:Belum Selesai,Proses,Selesai',
        ]);

        $biodataTamu->update($request->all());

        return redirect()->route('biodata-tamus.index')->with('success', 'Biodata tamu berhasil diperbarui.');
    }

    /**
     * Menghapus biodata tamu dari database.
     */
    public function destroy(BiodataTamu $biodataTamu)
    {
        $biodataTamu->delete();
        return redirect()->route('biodata-tamus.index')->with('success', 'Biodata tamu berhasil dihapus.');
    }
}
