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
        Schema::create('daftaropd', function (Blueprint $table) {
            $table->id();
            $table->integer('kementerian_id')->nullable();
            $table->integer('provinsi_id');
            $table->integer('kabupaten_id');
            $table->tinyInteger('status_opd')->default('1')->comment('1=kementerian,2=provinsi,3=kabupaten,4=lembaga-swasta');
            $table->string('nama_opd');
            $table->string('alamat')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daftaropd');
    }
};
