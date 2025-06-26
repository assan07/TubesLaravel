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
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();

            // Relasi ke pengguna (penghuni)
            $table->unsignedBigInteger('user_id');

            // Periode pembayaran
            $table->string('bulan'); // Januari, Februari, dst
            $table->year('tahun');

            // Informasi pembayaran
            $table->date('tanggal_bayar')->nullable(); // bisa kosong jika belum bayar
            $table->enum('status_pembayaran', ['pending', 'lunas', 'terlambat'])->default('pending');
            $table->enum('jenis_pembayaran', ['Cash', 'Non Cash']);

            // Harga disarankan pakai integer
            $table->unsignedBigInteger('harga'); // lebih baik daripada string

            $table->timestamps();

            // Relasi
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
