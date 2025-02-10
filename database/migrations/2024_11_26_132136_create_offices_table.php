<?php

use App\Enums\OfficeTypeEnum;
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
        Schema::create('offices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_id')->nullable()->constrained('offices')->onDelete('cascade');
            $table->string('code', 10)->unique();
            $table->string('name', 100);
            $table->string('region', 100);
            $table->enum('type', ['KCU', 'KC', 'KCP']);
            $table->text('address')->nullable();
            $table->string('zip_code', 10)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offices');
    }
};
