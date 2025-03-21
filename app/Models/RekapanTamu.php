<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RekapanTamu extends Model
{
    use HasFactory;

    protected $table = 'rekapan_tamus';
    protected $fillable = ['buku_tamu_id', 'biodata_tamu_id', 'tanggal_kunjungan', 'status'];

    public function bukuTamu()
    {
        return $this->belongsTo(BukuTamu::class, 'buku_tamu_id');
    }

    public function biodataTamu()
    {
        return $this->belongsTo(BiodataTamu::class, 'biodata_tamu_id');
    }
}
