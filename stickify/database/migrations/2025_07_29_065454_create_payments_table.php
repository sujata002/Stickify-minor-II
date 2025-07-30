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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
             $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('stripe_session_id')->nullable();
            $table->integer('amount'); // in cents, e.g., 20000 = $200.00
            $table->string('currency')->default('usd');
            $table->string('status')->default('pending'); // paid, failed, etc.
            $table->string('payment_method')->nullable();  // eg: card
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};