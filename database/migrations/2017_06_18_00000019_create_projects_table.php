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
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('public_work_id')->default(0)->nullable();
            $table->string('slug', 200)->nullable();
            $table->string('kh_title', 100)->nullable();
            $table->string('en_title', 100)->nullable();
			$table->string('en_background', 250)->nullable();
            $table->string('kh_background', 250)->nullable();
			$table->string('en_construction_type', 250)->nullable();
            $table->string('kh_construction_type', 250)->nullable();
			$table->string('en_category', 250)->nullable();
            $table->string('kh_category', 250)->nullable();
			$table->string('en_province', 250)->nullable();
            $table->string('kh_province', 250)->nullable();
			$table->string('en_location', 250)->nullable();
            $table->string('kh_location', 250)->nullable();
			$table->string('en_authority', 250)->nullable();
            $table->string('kh_authority', 250)->nullable();
			$table->string('en_constructor', 250)->nullable();
            $table->string('kh_constructor', 250)->nullable();
			$table->string('en_period', 250)->nullable();
            $table->string('kh_period', 250)->nullable();
            $table->text('en_note')->nullable();
            $table->text('kh_note')->nullable();
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
        Schema::dropIfExists('projects');
    }
}
