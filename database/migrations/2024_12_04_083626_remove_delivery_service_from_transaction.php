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
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn('delivery_service');
            $table->foreignId('sla_id')->after('types_of_goods')->constrained('service_level_agreements');
            $table->bigInteger('sla_actual')->default(0)->after('sla_id');
            $table->boolean('sla_status')->after('sla_actual')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->enum('delivery_service', ['regular', 'express', 'next day'])->after('types_of_goods');
            $table->dropForeign(['sla_id']);
            $table->dropColumn('sla_id');
            $table->dropColumn('sla_actual');
            $table->dropColumn('sla_status');
        });
    }
};
