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
        Schema::dropIfExists('partners');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('partners', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['marketplace', 'pemerintah', 'perbankan']);
            $table->string('code')->unique();
            $table->string('name');
            $table->timestamps();
        });
    }
};
