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
        Schema::create('page', function (Blueprint $table) {
            $table->id();
            $table->integer('page_id')->nullable();
            $table->string('titulo')->nullable();
            $table->text('descricao')->nullable();
            $table->string('slug')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->string('locale')->nullable();
            $table->boolean('css_app')->default(true);
            $table->boolean('header_footer')->default(true);
            $table->text('svg')->nullable();
            $table->string('imagem')->nullable();
            $table->integer('ordem')->default(0);            
            $table->boolean('status')->default(true);            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page');
    }
};
