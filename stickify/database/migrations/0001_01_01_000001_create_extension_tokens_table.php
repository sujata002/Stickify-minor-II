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
        Schema::create('extension_tokens', function (Blueprint $table) {  // fixed table name here
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('token')->unique();
            $table->dateTime('expires_at')->nullable(); // nullable to allow null values
            $table->boolean('is_used')->default(false);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('extension_tokens');  // fixed table name here
    }
};