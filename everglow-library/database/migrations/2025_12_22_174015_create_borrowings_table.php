<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::create('borrowings', function (Blueprint $table) {
        $table->id();

        $table->unsignedBigInteger('user_id');
        $table->unsignedBigInteger('book_id');

        $table->date('borrowed_at')->nullable();
        $table->date('returned_at')->nullable();
        $table->string('status')->default('Borrowed');

        $table->timestamps();

        // Foreign keys
        $table->foreign('user_id')
              ->references('id')
              ->on('users')
              ->onDelete('cascade');

        $table->foreign('book_id')
              ->references('id')
              ->on('books')
              ->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrowings');
    }
};
