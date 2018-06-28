<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Ronan Versendaal',
            'email' => 'ronanversendaal@hotmail.com',
            'password' => bcrypt('secret'),
        ]);
    }
}
