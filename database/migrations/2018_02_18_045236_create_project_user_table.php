<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('project_user')) {
            Schema::create('project_user', function (Blueprint $table) {
                $table->integer('id_project')->unsigned();
                $table->integer('id_user')->unsigned();
                $table->primary(['id_project', 'id_user']);
                $table->foreign('id_project')->references('id')->on('projects')
                    ->onUpdate('cascade')->onDelete('cascade');
                $table->foreign('id_user')->references('id')->on('users')
                    ->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('project_user');
    }
}
