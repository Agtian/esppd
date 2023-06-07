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
        Schema::create('pendidikankualifikasis', function (Blueprint $table) {
            $table->id();
            $table->integer('pendidikankualifikasi_id');
            $table->string('pendidikankualifikasi_kode', 100);
            $table->string('pendidikankualifikasi_nama', 100);
            $table->string('pendidikankualifikasi_namalainnya', 100);
            $table->text('pendidikankualifikasi_keterangan');
            $table->tinyInteger('pendidikankualifikasi_aktif')->default('0')->comment('0=aktif,1=nonaktif');
            $table->integer('jmlkeblaki');
            $table->integer('jmlkebperempuan');
            $table->integer('nourut');
            
            $table->unsignedBigInteger('pendidikan_id');
            $table->unsignedBigInteger('kelompokpegawai_id');
            
            $table->foreign('pendidikan_id')->references('id')->on('pendidikans')->onDelete('cascade');
            $table->foreign('kelompokpegawai_id')->references('id')->on('kelompokpegawais')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendidikankualifikasis');
    }
};
