<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePublicWorksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('public_works', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug', 200);
            $table->string('en_title', 100);
            $table->string('kh_title', 100);
			$table->text('kh_content');
            $table->text('en_content');
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
        Schema::dropIfExists('public_works');
    }
}
