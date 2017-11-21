<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Request;
use DB;
use Charts;
use Response;

class ThongKeQuanLiController extends Controller
{

/*---------------------------Thống kê khách hàng------------------------------*/
	public function getThongKeKhachHang(){
		$khachhang = DB::table('khach_hang')->get();

/*
		$count1 = 0; $count2 = 0; $count3 = 0; $count4 = 0; $count5 = 0; $count6 = 0; $count7 = 0; 
		$count8 = 0; $count9 = 0; $count10 = 0; $count11 = 0; $count12 = 0; 
		foreach ($khachhang as $val) {
			if(date('Y', strtotime($val->ngaytao)) == date('Y')){
				switch (date('m', strtotime($val->ngaytao))) {
					case '1':
						$count1 += 1;
						break;
					case '2':
						$count2 += 1;
						break;
					case '3':
						$count3 += 1;
						break;
					case '4':
						$count4 += 1;
						break;
					case '5':
						$count5 += 1;
						break;
					case '6':
						$count6 += 1;
						break;
					case '7':
						$count7 += 1;
						break;
					case '8':
						$count8 += 1;
						break;
					case '9':
						$count9 += 1;
						break;
					case '10':
						$count10 += 1;
						break;
					case '11':
						$count11 += 1;
						break;
					case '12':
						$count12 += 1;
						break;				
				}
			}
		}

		$chart = Charts::create('line', 'highcharts')
				    ->title('My nice chart')
				    ->labels(['First', 'Second', 'Third'])
				    ->values([5,10,20])
				    ->dimensions(0,500);

		return view('quanli.thongke.thongke_khachhang')->with('khachhang', $khachhang)->with('chart', $chart);  */
	}

/*------------Thống kê tài khoản nhà bán hàng, khách hàng----------------*/
	public function getThongKeTaiKhoan(){
		//Thống kê nhà bán hàng
		$nguoiban = DB::table('nguoi_ban')->get();

		$count1 = 0; $count2 = 0; $count3 = 0; $count4 = 0; $count5 = 0; $count6 = 0; $count7 = 0; 
		$count8 = 0; $count9 = 0; $count10 = 0; $count11 = 0; $count12 = 0; 
		foreach ($nguoiban as $val) {
			if(date('Y', strtotime($val->ngaytao)) == date('Y')){
				switch (date('m', strtotime($val->ngaytao))) {
					case '1':
						$count1 += 1;
						break;
					case '2':
						$count2 += 1;
						break;
					case '3':
						$count3 += 1;
						break;
					case '4':
						$count4 += 1;
						break;
					case '5':
						$count5 += 1;
						break;
					case '6':
						$count6 += 1;
						break;
					case '7':
						$count7 += 1;
						break;
					case '8':
						$count8 += 1;
						break;
					case '9':
						$count9 += 1;
						break;
					case '10':
						$count10 += 1;
						break;
					case '11':
						$count11 += 1;
						break;
					case '12':
						$count12 += 1;
						break;				
				}
			}
		}


		$chart_nguoiban = Charts::create('bar', 'highcharts')
				->title('Biểu đồ thống kê nhà bán hàng')
				->elementLabel('Số nhà bán hàng')
				->labels(['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 
        				'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'])
				->values([$count1, $count2, $count3, $count4, $count5, $count6, $count7, $count8, $count9, $count10, $count11, $count12])
				->dimensions(1000,500)
				->loader(false)
				->oneColor(true)
				->responsive(false);

		//Thống kê khách hàng
		$chart_khachhang = Charts::create('bar', 'highcharts')
				->title('Biểu đồ thống kê khách hàng')
				->elementLabel('Số khách hàng')
				->labels(['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 
        				'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'])
				->values([7, 2, $count3, $count4, 6, $count6, 18, $count8, 23, $count10, $count11, $count12])
				->dimensions(1000,500)
				->loader(false)
				->oneColor(true)
				->responsive(false);

		return view('quanli.thongke.thongke_taikhoan')->with('chart_nguoiban', $chart_nguoiban)->with('nguoiban', $nguoiban)->with('chart_khachhang',$chart_khachhang);
	}


}
