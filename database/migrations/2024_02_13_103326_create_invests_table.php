<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     */
    public function up(): void
    {
        Schema::create('invests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('order_id')->nullable()->constrained('orders')->onUpdate('cascade')->onDelete('cascade');
            $table->decimal('capital', 10, 2)->default(0);
            $table->decimal('daily_income', 10, 2)->default(0);
            $table->decimal('returns', 10, 2)->default(0);
            $table->integer('rate')->default(0);
            $table->integer('days')->default(0);
            $table->integer('days_paid')->default(0);
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->enum('status', ['no_investments', 'active', 'completed'])->default('no_investments');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invests');
    }
};
