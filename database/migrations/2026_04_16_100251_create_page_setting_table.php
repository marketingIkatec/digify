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
        Schema::create('pageSettings', function (Blueprint $table) {
            $table->id();
            $table->string('table')->nullable();
            $table->string('table_id')->nullable();
            $table->string('setting')->nullable();
            $table->string('setting_id')->nullable();
            $table->integer('status')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pageSettings');
    }
};
