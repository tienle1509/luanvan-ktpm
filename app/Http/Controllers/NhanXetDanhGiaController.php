<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Request;
use Response;
use DB;
use Validator;
use App\NhanXetDanhGia;
use Carbon\Carbon;

class NhanXetDanhGiaController extends Controller
{	
/*------------------------Mã nhận xét đánh giá tự tăng-----------------------------*/
	public function maNhanXetDanhGia(){
		$ds_manxdg = DB::table('nhanxet_danhgia')->select('manxdg')->get();
		$max = 0;

		foreach ($ds_manxdg as $value) {
			$cat_chuoi = substr($value->manxdg, 5);
			if($cat_chuoi > $max)
				$max = $cat_chuoi;
		}

		$chuoi_so = $max+1;
		if($chuoi_so < 10){
            $manxdg = 'NXDG00'.$chuoi_so;
        }else{
            $manxdg = 'NXDG0'.$chuoi_so;
        }
        return $manxdg;
	}

/*---------------------------Lưu nhận xét đánh giá-------------------------------------*/
	public function postNhanXet(){
		if(Request::ajax()){
			$masp = Request::get('masp');
			$sosao = Request::get('sosao');
			$tieude = Request::get('tieude');
			$mota = Request::get('mota');
			$manxdg = $this->maNhanXetDanhGia();

			$v = Validator::make(Request::all(),
				[
					'sosao'=>'required',
					'tieude'=>'required',
					'mota'=>'required'
				],
				[
					'sosao.required'=>'Bạn chưa chọn sao đánh giá',
					'tieude.required'=>'Tiêu đề đánh giá không được rỗng',
					'mota.required'=>'Mô tả không được rỗng'
				]);
			if($v->fails()){
				return Response::json([
					'success'=>false,
					'errors'=>$v->errors()->toArray()
				]);
			}else{
				if(isset($_SESSION['makh'])){
					$makh = $_SESSION['makh'];
				}else{
					$makh = '';
				}

				//Thêm nhận xét vào bảng
				$nx = new NhanXetDanhGia();
				$nx->manxdg = $manxdg;
				$nx->tieudenx = $tieude;
				$nx->noidungnx = $mota;
				$nx->saodg = $sosao;
				$nx->thoigiannxdg = date('Y-m-d',strtotime(Carbon::now()));
				$nx->masp = $masp;			
				$nx->makh = $makh;
				$nx->save();

				return Response::json(['success'=>true, 'masp'=>$masp]);
			}
		}
	}
}
