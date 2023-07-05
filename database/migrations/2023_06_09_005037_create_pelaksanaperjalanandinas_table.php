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
        Schema::create('pelaksanaperjalanandinas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('perjalanandinas_id');
            $table->unsignedBigInteger('pegawai_id');
            $table->string('gelardepan', 20);
            $table->string('nama_pegawai', 255);
            $table->string('gelarbelakang_nama', 20);
            $table->string('nomorindukpegawai', 50);
            $table->string('jabatan', 50);
            $table->string('pangkat', 50);
            $table->string('golongan', 50);
            $table->string('unit_kerja', 50);
            $table->date('tgl_sppd');
            $table->integer('uang_harian');
            $table->integer('biaya_transport');
            $table->integer('biaya_penginapan');
            $table->integer('uang_representasi');
            $table->integer('biaya_pesawat');
            $table->integer('biaya_lainnya');
            $table->integer('total_biaya');
            
            $table->foreign('perjalanandinas_id')->references('id')->on('perjalanandinas')->onDelete('cascade');
            $table->foreign('pegawai_id')->references('id')->on('pegawais')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelaksanaperjalanandinas');
    }
};
