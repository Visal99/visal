<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('category_id')->default(0)->nullable();
            $table->integer('type_id')->default(0)->nullable();
            $table->string('slug', 200);
            $table->string('kh_title', 100);
            $table->string('en_title', 100);
            $table->boolean('published')->default(0);
            $table->string('pdf', 50)->default('');
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
        Schema::dropIfExists('documents');
    }
}
