<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('albums', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('article_id')
                    ->nullable()
                    ->references('id')
                    ->on('articles');

            $table->unsignedInteger('project_id')
                    ->nullable()
                    ->references('id')
                    ->on('projects');
            
            $table->timestamps();
        });

        Schema::create('images', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('album_id')->references('id')->on('albums');
            $table->string('path', 254);
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
        Schema::dropIfExists('albums');
        Schema::dropIfExists('images');
    }
}
