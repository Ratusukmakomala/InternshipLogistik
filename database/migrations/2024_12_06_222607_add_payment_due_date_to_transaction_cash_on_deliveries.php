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
        Schema::table('transaction_cash_on_deliveries', function (Blueprint $table) {
            $table->date('payment_due_date')->after('payment_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transaction_cash_on_deliveries', function (Blueprint $table) {
            $table->dropColumn('payment_due_date');
        });
    }
};
