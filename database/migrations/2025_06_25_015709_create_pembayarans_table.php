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
            $table->unsignedBigInteger('user_id'); // relasi ke users
            $table->string('bulan'); // contoh: 'januari', 'februari'
            $table->year('tahun'); // supaya bisa dilacak per tahun juga
            $table->date('tanggal_bayar')->nullable(); // tanggal transaksi
            $table->enum('status', ['belum', 'sudah'])->default('belum'); // status pembayaran
            $table->enum('jenis_pembayaran', ['Cash', 'Non Cash']);
            $table->string('harga');
            $table->timestamps();
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
