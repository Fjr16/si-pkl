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
        Schema::create('attendance_lists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->required();
            $table->time('jam_masuk')->nullable();
            $table->time('jam_pulang')->nullable();
            $table->enum('status', ['Hadir','Izin', 'Sakit', 'Tidak Hadir'])->default('Tidak Hadir');
            $table->text('keterangan')->nullable();
            $table->string('foto')->required();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendance_lists');
    }
};
