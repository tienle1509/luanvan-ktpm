<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Request;
use DB;
use Charts;
use Response;

class ThongKeQuanLiController extends Controller
{
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
		$khachhang = DB::table('khach_hang')->get();

		//Khách vãng lai
		$count1 = 0; $count2 = 0; $count3 = 0; $count4 = 0; $count5 = 0; $count6 = 0; $count7 = 0; 
		$count8 = 0; $count9 = 0; $count10 = 0; $count11 = 0; $count12 = 0; 
		//Khách thành viên
		$count1_tv = 0; $count2_tv = 0; $count3_tv = 0; $count4_tv = 0; $count5_tv = 0; $count6_tv = 0; $count7_tv = 0; 
		$count8_tv = 0; $count9_tv = 0; $count10_tv = 0; $count11_tv = 0; $count12_tv = 0; 
		foreach ($khachhang as $val) {
			if(date('Y', strtotime($val->ngaytao)) == date('Y') && $val->thanhvien == 0){
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

		//Thành viên
		foreach ($khachhang as $val) {
			if(date('Y', strtotime($val->ngaytao)) == date('Y') && $val->thanhvien == 1){
				switch (date('m', strtotime($val->ngaytao))) {
					case '1':
						$count1_tv += 1;
						break;
					case '2':
						$count2_tv += 1;
						break;
					case '3':
						$count3_tv += 1;
						break;
					case '4':
						$count4_tv += 1;
						break;
					case '5':
						$count5_tv += 1;
						break;
					case '6':
						$count6_tv += 1;
						break;
					case '7':
						$count7_tv += 1;
						break;
					case '8':
						$count8_tv += 1;
						break;
					case '9':
						$count9_tv += 1;
						break;
					case '10':
						$count10_tv += 1;
						break;
					case '11':
						$count11_tv += 1;
						break;
					case '12':
						$count12_tv += 1;
						break;				
				}
			}
		}

		$chart_khachhang = Charts::multi('bar', 'highcharts')
				->title('Biểu đồ thống kê khách hàng')
				->elementLabel('Số khách hàng')
				->labels(['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 
        				'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'])
				->dataset('Khách vãng lai', [$count1, $count2, $count3, $count4, $count5, $count6, $count7, $count8, $count9, $count10, $count11, $count12])
				->dataset('Khách thành viên', [$count1_tv, $count2_tv, $count3_tv, $count4_tv, $count5_tv, $count6_tv, $count7_tv, $count8_tv, $count9_tv, $count10_tv, $count11_tv, $count12_tv])
				->dimensions(1000,500)
				->loader(false)
				->responsive(false);

		

		return view('quanli.thongke.thongke_taikhoan')->with('chart_nguoiban', $chart_nguoiban)->with('nguoiban', $nguoiban)->with('chart_khachhang',$chart_khachhang)->with('khachhang',$khachhang);
	}


}
