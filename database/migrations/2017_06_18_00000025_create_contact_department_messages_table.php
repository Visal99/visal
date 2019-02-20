<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactDepartmentMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_department_messages', function (Blueprint $table) {
            $table->increments('id');
			
			$table->integer('contact_department_id')->default(0)->nullable();
            $table->string('name', 200);
			$table->string('organization', 100);
            $table->string('position', 100);
			$table->string('phone', 100);
			$table->string('email', 100);
			$table->string('subject', 100);
			$table->text('message');
			
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
        Schema::dropIfExists('contact_department_messages');
    }
}
