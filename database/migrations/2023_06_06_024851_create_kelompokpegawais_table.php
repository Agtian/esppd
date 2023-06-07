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
        Schema::create('kelompokpegawais', function (Blueprint $table) {
            $table->id();
            $table->integer('kelompokpegawai_id');
            $table->string('kelompokpegawai_nama', 50);
            $table->string('kelompokpegawai_namalainnya', 50);
            $table->text('kelompokpegawai_fungsi');
            $table->tinyInteger('kelompokpegawai_aktif')->default('0')->comment('0=aktif,1=nonaktif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelompokpegawais');
    }
};
