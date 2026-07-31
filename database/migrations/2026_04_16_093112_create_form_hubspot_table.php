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
        Schema::create('formHubSpot', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('form_name')->nullable();
            $table->string('form_id')->nullable();
            $table->string('form_title_button')->nullable();            
            $table->text('form_embedded')->nullable();
            $table->text('form_fields')->nullable();
            $table->text('form_sent')->nullable();  
            $table->text('form_sent_url')->nullable();  
            $table->text('form_table')->nullable();      
            $table->boolean('form_captcha')->default(false);                  
            $table->boolean('form_corporate_email')->default(false);                  
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formHubSpot');
    }
};
