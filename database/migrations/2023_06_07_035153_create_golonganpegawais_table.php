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
        Schema::create('golonganpegawais', function (Blueprint $table) {
            $table->id();
            $table->integer('golonganpegawai_id');
            $table->string('golonganpegawai_nama', 50);
            $table->string('golonganpegawai_namalainnya', 50);
            $table->tinyInteger('golonganpegawai_aktif')->default('0')->comment('0=aktif,1=nonaktif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('golonganpegawais');
    }
};
