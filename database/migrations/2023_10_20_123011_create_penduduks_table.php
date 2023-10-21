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
        Schema::create('penduduks', function (Blueprint $table) {
            $table->id();
            $table->string('name', 64);
            $table->char('nik', 24);
            $table->char('phone_number', 14);
            $table->text('address');
            $table->enum('gender', ['L', 'P']);
            $table->date('tgl_lahir');
            $table->unsignedBigInteger('kabupaten_id');
            $table->timestamps();

            $table->foreign('kabupaten_id')->references('id')->on('kabupatens');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penduduks');
    }
};
