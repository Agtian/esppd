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
        Schema::create('instalasis', function (Blueprint $table) {
            $table->id();
            $table->integer('instalasi_id');
            $table->integer('riwayatruangan_id');
            $table->string('instalasi_nama', 100);
            $table->string('instalasi_namalainnya', 100);
            $table->string('instalasi_singkatan', 50);
            $table->string('instalasi_lokasi', 100);
            $table->tinyInteger('instalasirujukaninternal')->default('1')->comment('0=ya,1=tidak');
            $table->tinyInteger('instalasi_adakamar')->default('1')->comment('0=ya,1=tidak');
            $table->string('instalasi_image', 200);
            $table->tinyInteger('revenuecenter')->default('0')->comment('0=aktif,1=nonaktif');
            $table->tinyInteger('instalasi_aktif')->default('0')->comment('0=aktif,1=nonaktif');
            $table->integer('profiler_id');
            $table->tinyInteger('ispelayanan')->default('1')->comment('0=ya,1=tidak');
            $table->tinyInteger('ispenunjangmedis')->default('1')->comment('0=ya,1=tidak');
            $table->tinyInteger('ispenjunjangnonmedis')->default('1')->comment('0=ya,1=tidak');
            $table->tinyInteger('isadministrasi')->default('1')->comment('0=ya,1=tidak');
            $table->integer('profilrs_id');
            $table->text('instalasi_unggulan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instalasis');
    }
};
