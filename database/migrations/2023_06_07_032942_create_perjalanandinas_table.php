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
        Schema::create('perjalanandinas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('pegawai_id');
            $table->string('no_sppd', 50);
            $table->text('dasar');
            $table->text('lokasi_ditetapkan');
            $table->date('tgl_ditetapkan');
            $table->integer('jumlah_hari');
            $table->string('hari', 50);
            $table->date('tgl_mulai');
            $table->date('tgl_selesai');
            $table->date('tgl_sppd');
            $table->text('maksud_perjalanan');
            $table->text('tempat_tujuan');
            $table->time('jam_acara');
            $table->integer('uang_harian');
            $table->integer('biaya_transport');
            $table->integer('biaya_penginapan');
            $table->integer('uang_representasi');
            $table->integer('biaya_pesawat');
            $table->integer('biaya_lainnya');
            $table->integer('total_biaya');
            $table->tinyInteger('status_sppd')->default('0')->comment('0=aktif,1=selesai,2=batal');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('pegawai_id')->references('id')->on('pegawais')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perjalanandinas');
    }
};
