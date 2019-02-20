<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePressCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('press_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug', 200);
            $table->string('name', 100);
            
            $table->integer('deleter_id')->default(1)->unsigned()->index()->nullable();
            $table->integer('creator_id')->default(1)->unsigned()->index()->nullable();
            $table->integer('updater_id')->default(1)->unsigned()->index()->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('press_categories');
    }
}
