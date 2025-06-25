<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('mahasiswa', function (Blueprint $table) {
            $table->string('phone')->nullable()->change();
            $table->string('prodi')->nullable()->change();
            $table->enum('gender', ['lakilaki', 'perempuan'])->nullable()->change();
            $table->integer('semester')->nullable()->change();
            $table->integer('umur')->nullable()->change();
            $table->text('alamat')->nullable()->change();
            $table->string('foto')->nullable()->change();
          
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('mahasiswa', function (Blueprint $table) {
            $table->string('phone')->nullable(false)->change();
            $table->string('prodi')->nullable(false)->change();
            $table->enum('gender', ['lakilaki', 'perempuan'])->nullable(false)->change();
            $table->integer('semester')->nullable(false)->change();
            $table->integer('umur')->nullable(false)->change();
            $table->text('alamat')->nullable(false)->change();
            $table->string('foto')->nullable(false)->change();
        });
    }
};
