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
        Schema::create('accountDigifyHubspot', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('digify_account_id')->nullable();
            $table->string('hubspot_account_id')->nullable();
            $table->string('hubspot_deal_id')->nullable();
            $table->timestamp('first_login')->nullable();
            $table->longText('properties')->nullable();            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accountDigifyHubspot');
    }
};
