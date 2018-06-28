<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'projects', function (Blueprint $table) {
                $table->increments('id');
                $table->string('title', 128);
                $table->string('head', 128)->nullable();
                $table->text('description');
                $table->string('demo_url')->nullable();
                $table->string('client')->nullable();
                $table->string('client_url')->nullable();
                $table->string('image', 256)->nullable();
                $table->timestamp('published_at')->nullable();
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
        Schema::dropIfExists('projects');
    }
}
