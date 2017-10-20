<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
    }
}


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        	array(
        		'mataikhoan'=>'QL002',
        		'tentaikhoan'=>'Lê Thúy Hằng',
        		'email'=>'hang1029@gmail.com',
        		'password'=>Hash::make('hang12345'),
                'quyen'=>'3'
        	)
        ]);
    }
}


