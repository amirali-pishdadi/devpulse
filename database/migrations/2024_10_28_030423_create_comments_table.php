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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('article_id');
            $table->unsignedBigInteger('user_id');
            $table->boolean('is_checked');
            $table->text('content');
            $table->timestamps();

            $table->foreign('user_id')
                ->references("id")
                ->on("users")
                ->onDelete('cascade');
            $table->foreign('article_id')
                ->references("id")
                ->on("articles")
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
