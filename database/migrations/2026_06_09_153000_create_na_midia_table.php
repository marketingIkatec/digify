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
       Schema::create('blogImprensa', function (Blueprint $table) {
            $table->id();
            $table->string('imprensa');
            $table->string('imagem')->nullable();
            $table->string('url')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        }); 

        Schema::create('naMidia', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable();
            $table->longText('content');
            $table->string('imagem')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->string('source_url')->nullable(); // Link original da matéria
            $table->foreignId('autor_id')->nullable()->constrained('blogsAutor')->nullOnDelete();
            $table->foreignId('categoria_id')->nullable()->constrained('blogsCategoria')->nullOnDelete();
            $table->foreignId('id_imprensa')->nullable()->constrained('blogImprensa')->nullOnDelete();
            $table->string('brand'); // Ikatec, Digify, Weuny, Therux, Auxilium, Facilita Ponto, CampLearning
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('naMidia');
        Schema::dropIfExists('blogImprensa');
    }
};
