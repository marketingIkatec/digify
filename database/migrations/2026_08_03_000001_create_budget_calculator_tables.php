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
        Schema::create('budget_plans', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->string('name');
            $table->decimal('price', 10, 2)->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('active')->default(true);
            $table->timestamps();
        });

        Schema::create('budget_plan_extra_prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('budget_plan_id')->constrained('budget_plans')->cascadeOnDelete();
            $table->string('key');
            $table->string('name');
            $table->decimal('price', 10, 2)->default(0);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();

            $table->unique(['budget_plan_id', 'key']);
        });

        Schema::create('budget_modules', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->string('name');
            $table->decimal('price', 10, 2)->default(0);
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('active')->default(true);
            $table->timestamps();
        });

        Schema::create('budget_features', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('active')->default(true);
            $table->timestamps();
        });

        Schema::create('budget_module_plan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('budget_module_id')->constrained('budget_modules')->cascadeOnDelete();
            $table->foreignId('budget_plan_id')->constrained('budget_plans')->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['budget_module_id', 'budget_plan_id']);
        });

        Schema::create('budget_feature_plan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('budget_feature_id')->constrained('budget_features')->cascadeOnDelete();
            $table->foreignId('budget_plan_id')->constrained('budget_plans')->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['budget_feature_id', 'budget_plan_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('budget_feature_plan');
        Schema::dropIfExists('budget_module_plan');
        Schema::dropIfExists('budget_features');
        Schema::dropIfExists('budget_modules');
        Schema::dropIfExists('budget_plan_extra_prices');
        Schema::dropIfExists('budget_plans');
    }
};
