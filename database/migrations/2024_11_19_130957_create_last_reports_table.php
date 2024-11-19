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
        Schema::create('last_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->required();
            $table->date('tanggal')->required();
            $table->string('file_name')->required();
            $table->string('file_path')->required();
            $table->integer('file_size')->required();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('last_reports');
    }
};
