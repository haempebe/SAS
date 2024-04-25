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
        Schema::create('absensi', function (Blueprint $table) {
            $table->id();
            $table->integer('tendik_id')->nullable();
            $table->foreign('tendik_id')->references('nik')->on('tendik')->onDelete('cascade');
            $table->integer('siswa_id')->nullable();
            $table->foreign('siswa_id')->references('nisn')->on('siswa')->onDelete('cascade');
            $table->dateTime('jam_masuk')->nullable();
            $table->dateTime('jam_pulang')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensi');
    }
};
