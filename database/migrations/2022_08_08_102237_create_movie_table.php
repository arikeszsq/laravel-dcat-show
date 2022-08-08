<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMovieTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movie', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->default('NULL')->nullable()->comment('电影标题');
            $table->string('director')->default('NULL')->nullable()->comment('导演');
            $table->string('describe')->default('NULL')->nullable()->comment('简介');
            $table->string('rate')->default('NULL')->nullable()->comment('打分');
            $table->tinyInteger('released')->default('NULL')->nullable()->comment('是否发布');
            $table->dateTime('release_at')->default('NULL')->nullable()->comment('发布时间');
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
        Schema::dropIfExists('movie');
    }
}
