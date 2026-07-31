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
        Schema::create('blogs_categorias', function (Blueprint $table) {
            // campos das chaves estrangeiras
            $table->unsignedBigInteger('id_blog');
            $table->unsignedBigInteger('id_categoria');

            // chaves estrangeiras com cascade
            $table->foreign('id_blog')
                  ->references('id')
                  ->on('blogs')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');

            $table->foreign('id_categoria')
                  ->references('id')
                  ->on('blogsCategoria')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs_categorias');
    }
};
