<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BiodataTamu extends Model
{
    use HasFactory;

    protected $table = 'biodata_tamus';
    protected $fillable = ['buku_tamu_id', 'permasalahan', 'tanggapan', 'status'];

    public function bukuTamu()
    {
        return $this->belongsTo(BukuTamu::class, 'buku_tamu_id');
    }

    public function rekapan()
    {
        return $this->hasOne(RekapanTamu::class, 'biodata_tamu_id');
    }
}
