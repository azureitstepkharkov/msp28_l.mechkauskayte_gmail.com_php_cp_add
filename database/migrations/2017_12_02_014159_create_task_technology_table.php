<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaskTechnologyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('task_technology')) {
            Schema::create('task_technology', function (Blueprint $table) {
                $table->integer('id_task')->unsigned();
                $table->integer('id_technology')->unsigned();
                $table->primary(['id_task', 'id_technology']);
                $table->foreign('id_task')->references('id')->on('tasks')
                    ->onUpdate('cascade')->onDelete('cascade');
                $table->foreign('id_technology')->references('id')->on('technologies')
                    ->onUpdate('cascade')->onDelete('cascade');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('task_technology');
    }
}
