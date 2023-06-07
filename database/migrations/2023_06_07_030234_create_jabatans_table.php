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
        Schema::create('jabatans', function (Blueprint $table) {
            $table->id();
            $table->integer('jabatan_id');
            $table->integer('indexing_id');
            $table->integer('jabatan_urutan');
            $table->string('jabatan_nama', 100);
            $table->string('jabatan_lainnya', 100);
            $table->tinyInteger('jabatan_aktif')->default('0')->comment('0=aktif,1=nonaktif');
            $table->float('nominal_sip', 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jabatans');
    }
};
