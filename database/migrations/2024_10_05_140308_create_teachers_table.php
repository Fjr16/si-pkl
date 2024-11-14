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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('jk');
            $table->string('tmp_lhr');
            $table->string('tgl_lhr');
            $table->string('alamat');
            $table->string('no_hp');
            $table->string('golongan');
            $table->string('bidang_studi');
            $table->string('pend_terakhir');
            $table->string('gol_darah');
            $table->string('jabatan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
