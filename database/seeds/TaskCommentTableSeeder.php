<?php

use Illuminate\Database\Seeder;

class TaskCommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('task_comment')->insert([
            'task_id' => 1,
            'comment' => "Some strange comment...",
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

        DB::table('task_comment')->insert([
            'task_id' => 2,
            'comment' => "Some silly comment...",
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

        DB::table('task_comment')->insert([
            'task_id' => 3,
            'comment' => "Some important comment...",
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);
    }
}
