<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactDepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_departments', function (Blueprint $table) {
            $table->increments('id');
			
			$table->integer('contact_id')->default(0)->nullable();
            $table->string('slug', 200);
			$table->string('kh_title', 100);
            $table->string('en_title', 100);
			$table->string('website', 100);
			$table->string('phone', 100);
			$table->string('email', 100);
			$table->string('address', 100);
			$table->string('lat', 100);
			$table->string('lon', 100);
			
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
        Schema::dropIfExists('contact_departments');
    }
}
