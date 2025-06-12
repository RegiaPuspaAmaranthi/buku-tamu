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
        // Ambil semua tamu, termasuk relasi ke biodata jika ada
        $bukuTamus = BukuTamu::with('biodata')->latest()->get();
        return view('biodata_tamus.index', compact('bukuTamus'));
    }


    /**
     * Menampilkan form untuk menambah biodata tamu.
     */
    public function create(Request $request)
    {
        $bukuTamu = BukuTamu::findOrFail($request->buku_tamu_id);
        return view('biodata_tamus.create', compact('bukuTamu'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'buku_tamu_id' => 'required|exists:buku_tamus,id',
            'permasalahan' => 'required',
            'tanggapan' => 'required',
            'status' => 'required',
        ]);

        BiodataTamu::create($request->all());

        return redirect()->route('biodata-tamus.index')->with('success', 'Biodata berhasil disimpan.');
    }

    public function edit($id)
    {
        $biodata = BiodataTamu::with('bukuTamu')->findOrFail($id);
        return view('biodata_tamus.edit', compact('biodata'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'permasalahan' => 'required',
            'tanggapan' => 'required',
            'status' => 'required',
        ]);

        $biodata = BiodataTamu::findOrFail($id);
        $biodata->update($request->all());

        return redirect()->route('biodata-tamus.index')->with('success', 'Biodata berhasil diperbarui.');
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
