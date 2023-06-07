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
        Schema::create('konfigurasi_ttd', function (Blueprint $table) {
            $table->id();
            $table->string('nama_direktur', 100);
            $table->string('nip_direktur', 30);
            $table->string('nama_bendahara', 100);
            $table->string('nip_bendahara', 30);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('konfigurasi_ttd');
    }
};
