<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Drop any existing foreign key constraints first
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::dropIfExists('notifications');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        // Create the table with correct structure
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->text('message');
            $table->string('type');
            $table->string('status')->default('unread');
            $table->timestamps();
            
            $table->foreign('user_id', 'notifications_user_id_fk')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
