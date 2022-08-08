<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMovieCommentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movie_comment', function (Blueprint $table) {
            $table->increments('id');
            $table->text('content')->default('NULL')->nullable()->comment('电影评论');
            $table->integer('creator')->default('NULL')->nullable()->comment('评论人');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movie_comment');
    }
}
