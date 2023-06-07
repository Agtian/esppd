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
        Schema::create('pegawais', function (Blueprint $table) {
            $table->id();
            $table->string('gelardepan', 20);
            $table->string('nama_pegawai', 255);
            $table->string('gelarbelakang_nama', 20);
            $table->string('jeniskelamin', 20);
            $table->string('nama_keluarga', 255);
            $table->string('tempatlahirpegawai', 50);
            $table->date('tgl_lahirpegawai', 20);
            $table->text('alamat_pegawai');
            $table->tinyInteger('pegawai_aktif')->default('0')->comment('0=aktif,1=nonaktif');
            $table->string('agama', 10);
            $table->string('golongandarah', 5);
            $table->string('alamatemail', 255);
            $table->string('notelp_pegawai', 50);
            $table->string('nomobile_pegawai', 50);
            $table->string('photopegawai', 255);
            $table->unsignedBigInteger('unitkerja_id');
            $table->string('namaunitkerja', 255);
            $table->unsignedBigInteger('pendidikan_id');
            $table->string('pendidikan_nama', 255);
            $table->unsignedBigInteger('pendkualifikasi_id');
            $table->string('pendkualifikasi_nama', 255);
            $table->string('nomorindukpegawai', 50);
            $table->unsignedBigInteger('pangkat_id');
            $table->unsignedBigInteger('kelompokpegawai_id');
            $table->unsignedBigInteger('jabatan_id');
            $table->string('nama_jabatan', 100);

            $table->foreign('unitkerja_id')->references('id')->on('unitkerjas')->onDelete('cascade');
            $table->foreign('pendidikan_id')->references('id')->on('pendidikans')->onDelete('cascade');
            $table->foreign('pendkualifikasi_id')->references('id')->on('pendidikankualifikasis')->onDelete('cascade');
            $table->foreign('pangkat_id')->references('id')->on('pangkats')->onDelete('cascade');
            $table->foreign('kelompokpegawai_id')->references('id')->on('kelompokpegawais')->onDelete('cascade');
            $table->foreign('jabatan_id')->references('id')->on('jabatans')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawais');
    }
};
