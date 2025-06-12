<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Models\BukuTamu;
use App\Models\BiodataTamu;

class RekapanTamuController extends Controller
{
    public function index(Request $request)
    {
        $tipe = $request->input('tipe_data', 'buku');
        $tanggalAwal = $request->input('tanggal_awal');
        $tanggalAkhir = $request->input('tanggal_akhir');

        $data = [];

        if ($tipe === 'buku') {
            $query = BukuTamu::query();
        } else {
            $query = BiodataTamu::with('bukuTamu');
        }

        if ($tanggalAwal && $tanggalAkhir) {
            $query->whereBetween('created_at', [$tanggalAwal, $tanggalAkhir]);
        }

        $data = $query->get();

        return view('rekapan.index', compact('data', 'tipe', 'tanggalAwal', 'tanggalAkhir'));
    }

    public function export(Request $request)
    {
        $tipe = $request->input('tipe_data');
        $tanggalAwal = $request->input('tanggal_awal');
        $tanggalAkhir = $request->input('tanggal_akhir');
        $filenameInput = $request->input('filename');

        if ($tipe === 'buku') {
            $query = BukuTamu::query();
        } elseif ($tipe === 'biodata') {
            $query = BiodataTamu::with('bukuTamu');
        } else {
            return back()->with('error', 'Tipe data tidak valid.');
        }

        if ($tanggalAwal && $tanggalAkhir) {
            $query->whereBetween('created_at', [$tanggalAwal, $tanggalAkhir]);
        }

        $data = $query->get();
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        if ($tipe === 'buku') {
            $sheet->fromArray(['Nama', 'Instansi', 'Keperluan', 'Tanggal'], null, 'A1');
            foreach ($data as $index => $row) {
                $sheet->fromArray([
                    $row->nama,
                    $row->instansi,
                    $row->keperluan,
                    $row->created_at->format('Y-m-d'),
                ], null, 'A' . ($index + 2));
            }
        } else {
            $sheet->fromArray(['Nama', 'Instansi', 'Keperluan', 'No HP', 'Tanggal', 'Permasalahan', 'Tanggapan', 'Status'], null, 'A1');
            foreach ($data as $index => $row) {
                $sheet->fromArray([
                    optional($row->bukuTamu)->nama,
                    optional($row->bukuTamu)->instansi,
                    optional($row->bukuTamu)->keperluan,
                    optional($row->bukuTamu)->no_hp,
                    $row->created_at->format('Y-m-d'),
                    $row->permasalahan,
                    $row->tanggapan,
                    $row->status,
                ], null, 'A' . ($index + 2));
            }
        }

        $filename = $filenameInput ?: 'rekapan_' . $tipe . '_tamu.xlsx';
        $tempPath = tempnam(sys_get_temp_dir(), $filename);
        $writer = new Xlsx($spreadsheet);
        $writer->save($tempPath);

        return response()->download($tempPath, $filename)->deleteFileAfterSend(true);
    }
}
