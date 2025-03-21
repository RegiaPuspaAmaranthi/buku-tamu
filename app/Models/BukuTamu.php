<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BukuTamu extends Model
{
    use HasFactory;

    protected $table = 'buku_tamus';
    protected $fillable = ['nama', 'instansi', 'keperluan', 'tanggal'];

    public function biodata()
    {
        return $this->hasOne(BiodataTamu::class, 'buku_tamu_id');
    }
}
