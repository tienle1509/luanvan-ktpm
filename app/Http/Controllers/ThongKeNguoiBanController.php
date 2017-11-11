<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Charts;
use DB;

class ThongKeNguoiBanController extends Controller
{
    public function getThongKe(){
    	$dh_manb = DB::table('don_hang as dh')
					->join('chitiet_donhang as ct', 'ct.madh', '=', 'dh.madh')
					->where('dh.trangthai',1)
					->where('dh.mattdh',4)
					->where('ct.manb', $_SESSION['manb'])
					->select('dh.madh', 'dh.ngaydat', 'dh.tongtien')
					->distinct()
					->get();

		$tong1 = 0; $tong2 = 0; $tong3 = 0; $tong4 = 0; $tong5 = 0; $tong6 = 0; $tong7 = 0; 
		$tong8 = 0; $tong9 = 0; $tong10 = 0; $tong11 = 0; $tong12 = 0; 
		foreach ($dh_manb as $val) {			
			if(date('Y', strtotime($val->ngaydat)) == date('Y')){
				switch (date('m', strtotime($val->ngaydat))) {
					case '1':
						$tong1 += $val->tongtien;
						break;
					case '2':
						$tong2 += $val->tongtien;
						break;
					case '3':
						$tong3 += $val->tongtien;
						break;
					case '4':
						$tong4 += $val->tongtien;
						break;
					case '5':
						$tong5 += $val->tongtien;
						break;
					case '6':
						$tong6 += $val->tongtien;
						break;
					case '7':
						$tong7 += $val->tongtien;
						break;
					case '8':
						$tong8 += $val->tongtien;
						break;
					case '9':
						$tong9 += $val->tongtien;
						break;
					case '10':
						$tong10 += $val->tongtien;
						break;
					case '11':
						$tong11 += $val->tongtien;
						break;
					case '12':
						$tong12 += $val->tongtien;
						break;				
				}
			}
		}

        $chart = Charts::create('bar', 'highcharts')
				->title('Biểu đồ doanh thu')
				->elementLabel('Doanh thu')
				->labels(['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 
        				'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'])
				->values([$tong1, $tong2, $tong3, $tong4, $tong5, $tong6, $tong7, $tong8,
							$tong9, $tong10, $tong11, $tong12])
				->dimensions(1000,500)
				->loader(false)
				->oneColor(true)
				->responsive(false);


    	return view('nguoiban.thongke.thongke_doanhso')->with('chart',$chart)->with('dh_manb', $dh_manb);
    }
}
