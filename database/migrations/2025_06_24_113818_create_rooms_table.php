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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kamar');
            $table->string('no_kamar')->unique();
            $table->string('lokasi_kamar');
            $table->enum('jenis_kamar', ['laki-laki', 'perempuan']);
            $table->string('harga');
            $table->enum('status', ['tersedia', 'diisi', 'maintenance'])->default('tersedia');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
