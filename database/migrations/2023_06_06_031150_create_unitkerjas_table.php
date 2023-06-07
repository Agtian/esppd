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
        Schema::create('unitkerjas', function (Blueprint $table) {
            $table->id();
            $table->integer('unitkerja_id');
            $table->string('namaunitkerja', 200);
            $table->string('namalain', 200);
            $table->tinyInteger('unitkerja_aktif')->default('0')->comment('0=aktif,1=nonaktif');
            $table->integer('unitkerjaparent_id');
            $table->integer('unitkerjaunitpeg_id');
            $table->unsignedBigInteger('instalasi_id');
            
            $table->foreign('instalasi_id')->references('id')->on('instalasis')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unitkerjas');
    }
};
