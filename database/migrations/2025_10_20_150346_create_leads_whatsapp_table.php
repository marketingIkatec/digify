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
        Schema::create('leadsWhatsapp', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('email');
            $table->string('whatsapp');
            $table->string('url')->nullable();
            $table->string('voce_e_cliente')->nullable();
            $table->string('form_type')->nullable();
            $table->string('locale')->nullable();
            $table->json('extra_data')->nullable();
            $table->longText('mensagem')->nullable();
            $table->integer('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leadsWhatsapp');
    }
};
