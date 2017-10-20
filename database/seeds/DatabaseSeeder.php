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
        		'mataikhoan'=>'KH001',
        		'tentaikhoan'=>'Nguyễn Văn An',
        		'email'=>'an1234@gmail.com',
        		'password'=>Hash::make('an12345'),
                'quyen'=>'2'
        	)
        ]);
    }
}


