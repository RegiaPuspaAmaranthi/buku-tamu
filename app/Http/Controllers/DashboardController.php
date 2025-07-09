<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BiodataTamu;
use App\Models\BukuTamu;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Jumlah tamu per bulan (untuk grafik)
        $tamuPerBulan = BukuTamu::selectRaw('MONTH(tanggal) as bulan, COUNT(*) as jumlah')
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->pluck('jumlah', 'bulan')
            ->toArray();

        // Format bulan (1–12) ke nama bulan
        $bulan = [];
        $jumlahTamu = [];
        foreach (range(1, 12) as $i) {
            $bulan[] = Carbon::create()->month($i)->locale('id')->translatedFormat('F');
            $jumlahTamu[] = $tamuPerBulan[$i] ?? 0;
        }

        // Statistik Biodata
        $totalBiodata = BiodataTamu::count();
        $belumSelesai = BiodataTamu::where('status', 'Belum Selesai')->count();
        $proses = BiodataTamu::where('status', 'Proses')->count();
        $selesai = BiodataTamu::where('status', 'Selesai')->count();

        return view('admin.dashboard', compact(
            'totalBiodata',
            'belumSelesai',
            'proses',
            'selesai',
            'bulan',
            'jumlahTamu'
        ));
    }
}
