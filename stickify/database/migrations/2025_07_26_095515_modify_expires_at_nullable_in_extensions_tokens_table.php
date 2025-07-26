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
        Schema::table('extensions_tokens', function (Blueprint $table) {
            $table->timestamp('expires_at')->nullable()->change();                  // added this
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('extensions_tokens', function (Blueprint $table) {
            $table->timestamp('expires_at')->nullable(false)->change();   // added this
        });
    }
};


/* 

ran this in terminal to change the "not null" status of expires_at column to"null"
php artisan make:migration modify_expires_at_nullable_in_extensions_tokens_table


*/