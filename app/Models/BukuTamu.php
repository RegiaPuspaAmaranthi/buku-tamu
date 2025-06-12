<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BukuTamu extends Model
{
    use HasFactory;

    protected $table = 'buku_tamus';

    protected $fillable = ['nama', 'instansi', 'keperluan', 'tanggal', 'no_hp'];

    protected $casts = [
        'tanggal' => 'datetime',
    ];

    public function biodata()
    {
        return $this->hasOne(BiodataTamu::class, 'buku_tamu_id');
    }

    public function rekapan()
    {
        return $this->hasOne(RekapanTamu::class, 'buku_tamu_id');
    }
}
