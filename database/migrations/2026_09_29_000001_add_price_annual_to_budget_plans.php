<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('budget_plans', function (Blueprint $table) {
            $table->decimal('price_annual', 10, 2)->nullable()->after('price');
        });

        DB::table('budget_plans')
            ->select(['id', 'details'])
            ->orderBy('id')
            ->get()
            ->each(function ($plan) {
                $details = json_decode($plan->details ?? '[]', true) ?: [];

                if (!array_key_exists('annual_price', $details)) {
                    return;
                }

                $priceAnnual = $details['annual_price'];
                unset($details['annual_price']);

                DB::table('budget_plans')
                    ->where('id', $plan->id)
                    ->update([
                        'price_annual' => $priceAnnual,
                        'details' => json_encode($details),
                    ]);
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('budget_plans')
            ->select(['id', 'details', 'price_annual'])
            ->orderBy('id')
            ->get()
            ->each(function ($plan) {
                $details = json_decode($plan->details ?? '[]', true) ?: [];
                $details['annual_price'] = $plan->price_annual;

                DB::table('budget_plans')
                    ->where('id', $plan->id)
                    ->update(['details' => json_encode($details)]);
            });

        Schema::table('budget_plans', function (Blueprint $table) {
            $table->dropColumn('price_annual');
        });
    }
};
