<?php

use Illuminate\Database\Seeder;

class TaskFileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('task_file')->insert([
            'task_id' => 1,
            'path' => 'storage/111.jpg',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

        DB::table('task_file')->insert([
            'task_id' => 2,
            'path' => 'storage/222.jpg',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);
    }
}
