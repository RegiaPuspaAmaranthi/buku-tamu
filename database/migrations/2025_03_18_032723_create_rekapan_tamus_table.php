<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rekapan_tamus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('buku_tamu_id')->constrained('buku_tamus')->onDelete('cascade');
            $table->foreignId('biodata_tamu_id')->constrained('biodata_tamus')->onDelete('cascade');
            $table->date('tanggal_kunjungan');
            $table->enum('status', ['Belum Selesai', 'Proses', 'Selesai']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekapan_tamus');
    }
};
