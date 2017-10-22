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
        $this->call(QuanLiSeeder::class);
    }
}


class QuanLiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('nguoi_quanli')->insert([
        	array(
        		'maql'=>'QL001',
        		'tenql'=>'Lê Thị Cẩm Tiên',
        		'email'=>'tienb1304736@student.ctu.edu.vn',
        		'matkhau'=>Hash::make('tien12345')
        	)
        ]);
    }
}


