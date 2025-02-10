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
        Schema::table('service_level_agreements', function (Blueprint $table) {
            $table->text('description')->after('name')->nullable();
            $table->bigInteger('actual')->after('description')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('service_level_agreements', function (Blueprint $table) {
            $table->dropColumn('description');
            $table->dropColumn('actual');
        });
    }
};
