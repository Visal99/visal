<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAutomationVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('automation_videos', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('automation_system_id')->default(0)->nullable();
           
            $table->string('kh_title', 100);
            $table->string('en_title', 100);
            $table->string('image', 50)->default('');
			$table->integer('type_id')->default(0)->nullable();
			$table->integer('video_id')->default(0)->nullable();
            $table->boolean('published')->default(0);
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
        Schema::dropIfExists('automation_videos');
    }
}
