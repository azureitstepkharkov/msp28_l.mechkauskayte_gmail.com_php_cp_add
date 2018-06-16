<?php

use Illuminate\Database\Seeder;

class UserContactTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_contact')->insert([
            'user_id' => 2,
            'contact_id' => 1,
        ]);

        DB::table('user_contact')->insert([
            'user_id' => 2,
            'contact_id' => 2,
        ]);

        DB::table('user_contact')->insert([
            'user_id' => 2,
            'contact_id' => 3,
        ]);

        DB::table('user_contact')->insert([
            'user_id' => 2,
            'contact_id' => 4,
        ]);

        DB::table('user_contact')->insert([
            'user_id' => 2,
            'contact_id' => 5,
        ]);
    }
}
