<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presses', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('cateogry_id')->default(0)->nullable();
            $table->string('slug', 200);
            $table->string('kh_title', 100);
            $table->string('en_title', 100);
			 $table->string('kh_description', 250);
            $table->string('en_description', 250);
            $table->text('kh_content');
            $table->text('en_content');
            $table->boolean('published')->default(0);
			$table->boolean('featured')->default(0);
            $table->string('image', 50)->default('');
            $table->integer('num_of_views')->default(0)->unsigned()->index()->nullable();
            
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
        Schema::dropIfExists('presses');
    }
}
