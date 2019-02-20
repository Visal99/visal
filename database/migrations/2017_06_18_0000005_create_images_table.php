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
        Schema::create('images', function (Blueprint $table) {
            $table->increments('id');
            $table->string('page', 50);
            $table->string('slug', 50);
            $table->boolean('published')->default(1);
            $table->string('name', 50);
            $table->string('note', 100)->default('');
            $table->string('image', 50)->default('');
            $table->integer('width')->default(0)->unsigned()->index()->nullable();
            $table->integer('height')->default(0)->unsigned()->index()->nullable();
            $table->integer('updater_id')->default(1)->unsigned()->index()->nullable();
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
        Schema::dropIfExists('images');
    }
}
