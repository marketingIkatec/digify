<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('pageSettings', function (Blueprint $table) {
            $table->string('table', 50)->change();
            $table->string('setting', 50)->change();
            $table->unique(
                ['table', 'table_id', 'setting', 'setting_id'],
                'page_settings_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::table('pageSettings', function (Blueprint $table) {
            $table->dropUnique('page_settings_unique');
        });
    }
};