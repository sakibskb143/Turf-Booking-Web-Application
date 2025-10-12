<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('owner_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('code', 50)->unique();
            $table->enum('discount_type', ['flat', 'percent']);
            $table->decimal('discount_value', 10, 2);
            $table->date('expiry_date');
            $table->integer('usage_limit')->default(1);
            $table->enum('status', ['pending', 'approved', 'rejected', 'active', 'expired'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
