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
        Schema::create('menuAdmin', function (Blueprint $table) {
            $table->id();
            $table->integer('menu_id')->nullable();
            $table->string('menu');
            $table->string('titulo_do_menu');            
            $table->text('icone');
            $table->string('route');
            $table->integer('ordem')->default(0);
            $table->boolean('is_search')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menuAdmin');
    }
};
