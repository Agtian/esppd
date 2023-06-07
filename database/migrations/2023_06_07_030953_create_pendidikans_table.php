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
        Schema::create('pendidikans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pendidikan_id');
            $table->integer('indexing_id');
            $table->integer('pendidikan_urutan');
            $table->string('pendidikan_nama', 50);
            $table->string('pendidikan_namalainnya', 50);
            $table->tinyInteger('pendidian_aktif')->default('0')->comment('0=aktif,1=nonaktif');
            
            $table->foreign('pendidikan_id')->references('id')->on('pendidikans')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendidikans');
    }
};
