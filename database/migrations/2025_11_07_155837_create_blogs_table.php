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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('imagem')->nullable();
            $table->string('titulo')->nullable();
            $table->foreignId('autor_id')
                  ->constrained('blogsAutor')   // tabela referenciada
                  ->restrictOnDelete();

            $table->string('slug')->nullable();
            $table->text('resumo')->nullable();
            $table->longText('conteudo')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->integer('status')->default(0);
            $table->date('data_blog')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
