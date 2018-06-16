<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectTechnologyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('project_technology')) {
            Schema::create('project_technology', function (Blueprint $table) {
                $table->integer('id_project')->unsigned();
                $table->integer('id_technology')->unsigned();
                $table->primary(['id_project', 'id_technology']);
                $table->foreign('id_project')->references('id')->on('projects')
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
        Schema::dropIfExists('project_technology');
    }
}
