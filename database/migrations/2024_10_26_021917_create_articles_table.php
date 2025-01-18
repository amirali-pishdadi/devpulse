<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('content');

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
            $table->string('status')->default('draft');

            $table->unsignedBigInteger("category_id")->nullable();
            $table->unsignedBigInteger("author_id");

            $table->boolean('is_pinned')->default(false);

            $table->text('excerpt')->nullable();
            $table->string('featured_image_url')->nullable();
            $table->integer('reading_time')->nullable();

            $table->unsignedInteger('views_count')->default(0);
            $table->unsignedInteger('likes_count')->default(0);
            $table->index('slug');
            $table->index('status');


            $table->foreign('author_id')
                ->references("id")
                ->on("users")
                ->onDelete('cascade');
            $table->foreign('category_id')
                ->references("id")
                ->on("categories")
                ->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
