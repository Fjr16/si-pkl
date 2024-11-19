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
        Schema::create('teacher_monitorings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teacher_id')->required();
            $table->foreignId('student_id')->required();
            $table->text('kejadian')->nullable();
            $table->text('keterangan')->nullable();
            $table->string('tindakan')->nullable();
            $table->string('dokumentasi')->required();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teacher_monitorings');
    }
};
