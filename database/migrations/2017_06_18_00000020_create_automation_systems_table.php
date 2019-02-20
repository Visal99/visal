<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAutomationSystemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('automation_systems', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug', 200);
            $table->string('kh_title', 100);
            $table->string('en_title', 100);
			$table->string('kh_description', 500);
            $table->string('en_description', 500);
            $table->string('image', 50)->default('');
			$table->string('icon', 50)->default('');
			$table->string('api_url', 100)->default('');
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
        Schema::dropIfExists('automation_systems');
    }
}
