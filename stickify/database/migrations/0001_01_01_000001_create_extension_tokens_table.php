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
        Schema::create('extensions_tokens', function (Blueprint $table) {  // database table creation
         $table->id(); // primary key afai auto increment huncha 
         $table->unsignedBigInteger('user_id'); // FK to users table ,user ko id store garcha usertable bata basically
         // unsignedBigInteger vaneko it can store large positive integers
         $table->string('token')->unique(); // harek individual ko unique access key 
         //unique() ensures that no two tokens in the table can be the same.
         $table->dateTime('expires_at');
         // You can use this to check if a token is still valid.
         $table->boolean('is_used')->default(false);
         // to track if the token has been used or not.
         // default false haleko which means not yet used 
         $table->timestamps(); // created at updated at dubai huncha 
         // kaele create vako and kaele update vako 2 ota column created_at and updated_at halchaa
         // laravel handles yo automatically

         // Foreign Key Constraint
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        // foreign key relationship set up garcha
       // ondelete(cascade) ley chai if user is deleted all their tokens will also be deleted 
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('extensions_tokens');
    }
};
