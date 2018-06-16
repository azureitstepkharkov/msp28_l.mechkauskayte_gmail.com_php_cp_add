<?php

use Illuminate\Database\Seeder;

class UserCommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_comment')->insert([
            'user_id' => 2,
            'comment' => "Very good client! Pays in time.",
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

        DB::table('user_comment')->insert([
            'user_id' => 4,
            'comment' => "Very responsible dev!",
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);
    }
}
