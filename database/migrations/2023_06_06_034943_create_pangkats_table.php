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
        Schema::create('pangkats', function (Blueprint $table) {
            $table->id();
            $table->integer('pangkat_id');
            $table->unsignedBigInteger('golonganpegawai_id');
            $table->integer('pangkat_urutan');
            $table->string('pangkat_nama', 50);
            $table->string('pangkat_namalainnya', 50);
            $table->tinyInteger('pangkat_aktif')->default('0')->comment('0=aktif,1=nonaktif');
            
            $table->foreign('golonganpegawai_id')->references('id')->on('golonganpegawais')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pangkats');
    }
};
