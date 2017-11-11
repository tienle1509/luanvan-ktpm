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
					->join('khach_hang as kh', 'kh.makh', '=', 'dh.makh')
					->join('san_pham as sp', 'sp.masp', '=', 'ct.masp')
					->where('dh.trangthai',1)
					->where('sp.manb', $_SESSION['manb'])
					->select('dh.madh', 'dh.ngaydat', 'kh.tenkh', 'kh.diachigiaohang', 'kh.sodienthoai', 'dh.mahttt', 'dh.tongtien', 'ct.soluongct', 'dh.mattdh')
					->distinct()
					->paginate(10);

		$thanhtien1 = 0; $thanhtien2 = 0; $thanhtien3 = 0; $thanhtien4 = 0; $thanhtien5 = 0; 
		$thanhtien6 = 0; $thanhtien7 = 0; $thanhtien8 = 0; $thanhtien9 = 0; $thanhtien10 = 0;
		$thanhtien11 = 0; $thanhtien12 = 0;  

		foreach ($dh_manb as $val) {
			echo 'đơn hàng thứ : '.$val->madh.'<br>';
			$ctdh = DB::table('chitiet_donhang as ct')
						->join('san_pham as sp', 'sp.masp', '=', 'ct.masp')
						->where('ct.madh',$val->madh)
						->where('sp.manb', $_SESSION['manb'])
						->get();
			$tong1 = 0; $tong2 = 0; $tong3 = 0; $tong4 = 0; $tong5 = 0; $tong6 = 0; $tong7 = 0; 
			$tong8 = 0; $tong9 = 0; $tong10 = 0; $tong11 = 0; $tong12 = 0; 
			foreach ($ctdh as $valct) {
				//Kiểm tra sản phẩm có đang khuyến mãi hay không
				$km = DB::table('khuyen_mai as km')
						->join('chitiet_khuyenmai as ctkm', 'ctkm.makm', '=', 'km.makm')
						->where('ctkm.masp',$valct->masp)
						->get();
						if(count($km) != 0){
							$t = 0;
							foreach ($km as $valkm) {
								if(strtotime($val->ngaydat) >= strtotime($valkm->ngaybd) && strtotime($val->ngaydat) <= strtotime($valkm->ngaykt)){ 
									if(date('m',strtotime($val->ngaydat)) == 1){
										$tong1 += $valct->soluongct*($valct->dongia-$valct->dongia*0.01*$valkm->chietkhau);
										break;
									}else if(date('m',strtotime($val->ngaydat)) == 2){
										$tong2 += $valct->soluongct*($valct->dongia-$valct->dongia*0.01*$valkm->chietkhau);
										break;
									}else if(date('m',strtotime($val->ngaydat)) == 3){
										$tong3 += $valct->soluongct*($valct->dongia-$valct->dongia*0.01*$valkm->chietkhau);
										break;
									}else if(date('m',strtotime($val->ngaydat)) == 4){
										$tong4 += $valct->soluongct*($valct->dongia-$valct->dongia*0.01*$valkm->chietkhau);
										break;
									}else if(date('m',strtotime($val->ngaydat)) == 5){
										$tong5 += $valct->soluongct*($valct->dongia-$valct->dongia*0.01*$valkm->chietkhau);
										break;
									}else if(date('m',strtotime($val->ngaydat)) == 6){
										$tong6 += $valct->soluongct*($valct->dongia-$valct->dongia*0.01*$valkm->chietkhau);
										break;
									}else if(date('m',strtotime($val->ngaydat)) == 7){
										$tong7 += $valct->soluongct*($valct->dongia-$valct->dongia*0.01*$valkm->chietkhau);
										break;
									}else if(date('m',strtotime($val->ngaydat)) == 8){
										$tong8 += $valct->soluongct*($valct->dongia-$valct->dongia*0.01*$valkm->chietkhau);
										break;
									}else if(date('m',strtotime($val->ngaydat)) == 9){
										$tong9 += $valct->soluongct*($valct->dongia-$valct->dongia*0.01*$valkm->chietkhau);
										break;
									}else if(date('m',strtotime($val->ngaydat)) == 10){
										$tong10 += $valct->soluongct*($valct->dongia-$valct->dongia*0.01*$valkm->chietkhau);
										break;
									}else if(date('m',strtotime($val->ngaydat)) == 11){
										$tong11 += $valct->soluongct*($valct->dongia-$valct->dongia*0.01*$valkm->chietkhau);
										break;
									}else if(date('m',strtotime($val->ngaydat)) == 12){
										$tong12 += $valct->soluongct*($valct->dongia-$valct->dongia*0.01*$valkm->chietkhau);
										break;
									}									
									break; 
								} else {
									$t +=1;
								}
							}
							if($t == count($km)){ 								
								if(date('m',strtotime($val->ngaydat)) == 1){
									$tong1 += $valct->soluongct*$valct->dongia;
									break;
								}else if(date('m',strtotime($val->ngaydat)) == 2){
									$tong2 += $valct->soluongct*$valct->dongia;
									break;
								}else if(date('m',strtotime($val->ngaydat)) == 3){
									$tong3 += $valct->soluongct*$valct->dongia;
									break;
								}else if(date('m',strtotime($val->ngaydat)) == 4){
									$tong4 += $valct->soluongct*$valct->dongia;
									break;
								}else if(date('m',strtotime($val->ngaydat)) == 5){
									$tong5 += $valct->soluongct*$valct->dongia;
									break;
								}else if(date('m',strtotime($val->ngaydat)) == 6){
									$tong6 += $valct->soluongct*$valct->dongia;
									break;
								}else if(date('m',strtotime($val->ngaydat)) == 7){
									$tong7 += $valct->soluongct*$valct->dongia;
									break;
								}else if(date('m',strtotime($val->ngaydat)) == 8){
									$tong8 += $valct->soluongct*$valct->dongia;
									break;
								}else if(date('m',strtotime($val->ngaydat)) == 9){
									$tong9 += $valct->soluongct*$valct->dongia;
									break;
								}else if(date('m',strtotime($val->ngaydat)) == 10){
									$tong10 += $valct->soluongct*$valct->dongia;
									break;
								}else if(date('m',strtotime($val->ngaydat)) == 11){
									$tong11 += $valct->soluongct*$valct->dongia;
									break;
								}else if(date('m',strtotime($val->ngaydat)) == 12){
									$tong12 += $valct->soluongct*$valct->dongia;
									break;
								}						
							}
						}else{ 
							if(date('m',strtotime($val->ngaydat)) == 1){
								$tong1 += $valct->soluongct*$valct->dongia;
								break;
							}else if(date('m',strtotime($val->ngaydat)) == 2){
								$tong2 += $valct->soluongct*$valct->dongia;
								break;
							}else if(date('m',strtotime($val->ngaydat)) == 3){
								$tong3 += $valct->soluongct*$valct->dongia;
								break;
							}else if(date('m',strtotime($val->ngaydat)) == 4){
								$tong4 += $valct->soluongct*$valct->dongia;
								break;
							}else if(date('m',strtotime($val->ngaydat)) == 5){
								$tong5 += $valct->soluongct*$valct->dongia;
								break;
							}else if(date('m',strtotime($val->ngaydat)) == 6){
								$tong6 += $valct->soluongct*$valct->dongia;
								break;
							}else if(date('m',strtotime($val->ngaydat)) == 7){
								$tong7 += $valct->soluongct*$valct->dongia;
								break;
							}else if(date('m',strtotime($val->ngaydat)) == 8){
								$tong8 += $valct->soluongct*$valct->dongia;
								break;
							}else if(date('m',strtotime($val->ngaydat)) == 9){
								$tong9 += $valct->soluongct*$valct->dongia;
								break;
							}else if(date('m',strtotime($val->ngaydat)) == 10){
								$tong10 += $valct->soluongct*$valct->dongia;
								break;
							}else if(date('m',strtotime($val->ngaydat)) == 11){
								$tong11 += $valct->soluongct*$valct->dongia;
								break;
							}else if(date('m',strtotime($val->ngaydat)) == 12){
								$tong12 += $valct->soluongct*$valct->dongia;
								break;
							}		
						}
				//Kiểm tra đơn hàng có free ship hay không
				if($tong1 >= 300000){
					$tong1 = $tong1;
				}else{
					if($val->tongtien-27500 >= 300000){
						$tong1 = $tong1;
					}else{
						$tong1 = $val->tongtien;
					}
				}
				if($tong2 >= 300000){
					$tong2 = $tong2;
				}else{
					if($val->tongtien-27500 >= 300000){
						$tong2 = $tong2;
					}else{
						$tong2 = $val->tongtien;
					}
				}
				if($tong3 >= 300000){
					$tong3 = $tong3;
				}else{
					if($val->tongtien-27500 >= 300000){
						$tong3 = $tong3;
					}else{
						$tong3 = $val->tongtien;
					}
				}
				if($tong4 >= 300000){
					$tong4 = $tong4;
				}else{
					if($val->tongtien-27500 >= 300000){
						$tong4 = $tong4.'<br>';
					}else{
						$tong4 = $val->tongtien;
					}
				}
				if($tong5 >= 300000){
					$tong5 = $tong5;
				}else{
					if($val->tongtien-27500 >= 300000){
						$tong5 = $tong5;
					}else{
						$tong5 = $val->tongtien;
					}
				}
				if($tong6 >= 300000){
					$tong6 = $tong6;
				}else{
					if($val->tongtien-27500 >= 300000){
						$tong6 = $tong6;
					}else{
						$tong6 = $val->tongtien;
					}
				}
				if($tong7 >= 300000){
					$tong7 = $tong7;
				}else{
					if($val->tongtien-27500 >= 300000){
						$tong7 = $tong7;
					}else{
						$tong7 = $val->tongtien;
					}
				}
				if($tong8 >= 300000){
					$tong8 = $tong8;
				}else{
					if($val->tongtien-27500 >= 300000){
						$tong8 = $tong8;
					}else{
						$tong8 = $val->tongtien;
					}
				}
				if($tong9 >= 300000){
					$tong9 = $tong9;
				}else{
					if($val->tongtien-27500 >= 300000){
						$tong9 = $tong9;
					}else{
						$tong9 = $val->tongtien;
					}
				}
				if($tong10 >= 300000){
					$tong10 = $tong10;
				}else{
					if($val->tongtien-27500 >= 300000){
						$tong10 = $tong10;
					}else{
						$tong10 = $val->tongtien;
					}
				}
				if($tong11 >= 300000){
					$tong11 = $tong11;
				}else{
					if($val->tongtien-27500 >= 300000){
						$tong11 = $tong11;
					}else{
						$tong11 = $val->tongtien;
					}
				}
				if($tong12 >= 300000){
					$tong12 = $tong12;
				}else{
					if($val->tongtien-27500 >= 300000){
						$tong12 = $tong12;
					}else{
						$tong12 = $val->tongtien;
					}
				}
			}
			$thanhtien1 += $tong1;
			$thanhtien2 += $tong2;
			$thanhtien3 += $tong3;
			$thanhtien4 += $tong4;
			$thanhtien5 += $tong5;
			$thanhtien6 += $tong6;
			$thanhtien7 += $tong7;
			$thanhtien8 += $tong8;
			$thanhtien9 += $tong9;
			$thanhtien10 += $tong10;
			$thanhtien11 += $tong11;
			$thanhtien12 += $tong12;
		}

		// echo $thanhtien1.'<br>';
		// echo $thanhtien2.'<br>';
		// echo $thanhtien3.'<br>';
		// echo $thanhtien4.'<br>';
		// echo $thanhtien5.'<br>';
		// echo $thanhtien6.'<br>';
		// echo $thanhtien7.'<br>';
		// echo $thanhtien8.'<br>';
		// echo $thanhtien9.'<br>';
		// echo $thanhtien10.'<br>';
		// echo $thanhtien11.'<br>';
		// echo $thanhtien12.'<br>';

    

        $chart = Charts::create('bar', 'highcharts')
				->title("Biểu đồ doanh thu")
				->elementLabel('Doanh thu')
				->labels(['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 
        				'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'])
				->values([$thanhtien1,$thanhtien2,$thanhtien3, $thanhtien4, $thanhtien5,
						$thanhtien6, $thanhtien7, $thanhtien8, $thanhtien9, $thanhtien10,
						$thanhtien11, $thanhtien12])
				->dimensions(1000,500)
				->responsive(false);


    	return view('nguoiban.thongke.thongke_doanhso')->with('chart',$chart);
    }
}
