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
        Schema::table('transaction_histories', function (Blueprint $table) {
            $table->foreignId('sender_office_id')->after('transaction_id')->nullable()->constrained('offices')->onDelete('cascade');
            $table->foreignId('receiver_office_id')->after('sender_office_id')->nullable()->constrained('offices')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transaction_histories', function (Blueprint $table) {
            $table->dropForeign(['sender_office_id']);
            $table->dropForeign(['receiver_office_id']);
            $table->dropColumn('sender_office_id');
            $table->dropColumn('receiver_office_id');
        });
    }
};
