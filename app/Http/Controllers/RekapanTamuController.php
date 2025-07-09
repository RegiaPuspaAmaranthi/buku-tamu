<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Models\BukuTamu;
use App\Models\BiodataTamu;
use Illuminate\Database\Eloquent\Builder;

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
            if ($tanggalAwal && $tanggalAkhir) {
                $query->whereBetween('tanggal', [$tanggalAwal, $tanggalAkhir]);
            }
            $data = $query->get();
        } elseif ($tipe === 'biodata') {
            $query = BiodataTamu::with(['bukuTamu' => function ($q) use ($tanggalAwal, $tanggalAkhir) {
                if ($tanggalAwal && $tanggalAkhir) {
                    $q->whereBetween('tanggal', [$tanggalAwal, $tanggalAkhir]);
                }
            }]);

            $data = $query->get()->filter(function ($item) {
                return $item->bukuTamu !== null;
            });
        }

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
            if ($tanggalAwal && $tanggalAkhir) {
                $query->whereBetween('tanggal', [$tanggalAwal, $tanggalAkhir]);
            }
            $data = $query->latest('tanggal')->get();
        } elseif ($tipe === 'biodata') {
            $query = BiodataTamu::with('bukuTamu');
            if ($tanggalAwal && $tanggalAkhir) {
                $query->whereHas('bukuTamu', function ($q) use ($tanggalAwal, $tanggalAkhir) {
                    $q->whereBetween('tanggal', [$tanggalAwal, $tanggalAkhir]);
                });
            }
            $data = $query->latest()->get();
        } else {
            return back()->with('error', 'Tipe data tidak valid.');
        }

        // Buat Spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        if ($tipe === 'buku') {
            $sheet->fromArray(['Nama', 'Instansi', 'Nomor HP', 'Keperluan', 'Tanggal'], null, 'A1');
            foreach ($data as $index => $row) {
                $sheet->fromArray([
                    $row->nama,
                    $row->instansi,
                    $row->no_hp,
                    $row->keperluan,
                    $row->tanggal->format('d-m-Y'),
                ], null, 'A' . ($index + 2));
            }
        } else {
            $sheet->fromArray(['Nama', 'Instansi', 'Nomor HP', 'Keperluan', 'Tanggal', 'Permasalahan', 'Tanggapan', 'Status'], null, 'A1');
            foreach ($data as $index => $row) {
                $sheet->fromArray([
                    optional($row->bukuTamu)->nama,
                    optional($row->bukuTamu)->instansi,
                    optional($row->bukuTamu)->no_hp,
                    optional($row->bukuTamu)->keperluan,
                    optional($row->bukuTamu)->tanggal ? $row->bukuTamu->tanggal->format('d-m-Y') : '',
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
