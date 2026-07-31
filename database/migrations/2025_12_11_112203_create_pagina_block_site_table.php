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
        Schema::create('pageBlock', function (Blueprint $table) {
            $table->id();
            // chaves estrangeiras com cascade
            $table->unsignedBigInteger('page_id');
            $table->foreign('page_id')
                  ->references('id')
                  ->on('page')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->string('tipo_bloco'); // hero, features, cta...
            $table->string('nome_dobra')->nullable();
            $table->string('titulo')->nullable();
            $table->string('subtitulo2')->nullable();
            $table->longText('subtitulo3')->nullable();
            $table->longText('conteudo')->nullable();
            $table->json('configuracao')->nullable();
            $table->integer('ordem')->default(0);
            $table->boolean('status')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pageBlock');
    }
};
