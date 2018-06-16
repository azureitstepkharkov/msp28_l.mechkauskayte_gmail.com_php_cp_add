<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaskUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('task_user')) {
            Schema::create('task_user', function (Blueprint $table) {
                $table->integer('id_task')->unsigned();
                $table->integer('id_user')->unsigned();
                $table->primary(['id_task', 'id_user']);
                $table->foreign('id_task')->references('id')->on('tasks')
                    ->onUpdate('cascade')->onDelete('cascade');
                $table->foreign('id_user')->references('id')->on('users')
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
        Schema::dropIfExists('task_user');
    }
}
