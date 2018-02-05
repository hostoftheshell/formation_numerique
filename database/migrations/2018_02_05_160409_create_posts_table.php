<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'posts', function (Blueprint $table) {
                $table->increments('id'); // pk
                $table->unsignedInteger('category_id')->nullable(); //peut être NULL
                $table->enum('post_type', ['stage','formation']);
                $table->string('title', 100);
                $table->text('description')->nullable();
                $table->dateTime('started');
                $table->dateTime('ended');
                $table->decimal('price', 6, 2);
                $table->integer('student_max');
                $table->enum('status', ['published', 'unpublished'])
                    ->default('unpublished');
                $table->foreign('category_id')->references('id')->on('categories')->onDelete('SET NULL'); // fk, ici on peut supprimer une catégorie sans supprimer le stage ou formation associée.
                $table->timestamps();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
