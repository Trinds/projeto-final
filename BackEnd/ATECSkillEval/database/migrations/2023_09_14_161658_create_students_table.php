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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->longText('nome');
            $table->string('turma_edicao', 95);
            $table->foreign('turma_edicao')->references('edicao')->on('classrooms');
            $table->longText('localidade');
            $table->longText('email');
            $table->dateTime('data_nascimento');
            $table->dateTime('data_criacao');
            $table->timestamps();           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
