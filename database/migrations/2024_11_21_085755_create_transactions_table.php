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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('receipt_number')->unique();
            $table->dateTime('transaction_date');
            $table->date('first_delivery_date')->nullable();
            $table->date('receive_date')->nullable();
            $table->string('shipping_form')->nullable();
            $table->string('types_of_goods')->nullable();
            $table->enum('delivery_service', ['regular', 'express', 'next day']);
            $table->enum('kind_delivery', ['document', 'package']);
            $table->enum('type', ['customer', 'partner']);
            $table->enum('delivery_type', ['cod', 'non cod']);
            $table->double('weight')->default(0);
            $table->double('volume')->default(0);
            $table->double('item_value')->nullable();
            $table->double('base_price')->default(0);
            $table->double('tax_price')->default(0);
            $table->string('status')->default('pending');
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
