<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Request;
use Validator;
use Response;
use DB;
use File;

class CapNhatSoLuongSanPhamController extends Controller
{

/*----------------------Cập nhật số lượng sản phẩm-------------------------------*/
    public function postCapNhatSoLuong(){
    	if(Request::ajax()){
    		$masp = Request::get('masp');
    		$soluong = Request::get('soluong');

    		$v = Validator::make(Request::all(),
    			[
    				'soluong'=>'required'
    			],
    			[
    				'soluong.required'=>'Số lượng sản phẩm không được rỗng !'
    			]);
    		if($v->fails()){
    			return Response::json([
    				'success'=>false,
    				'errors'=>$v->errors()->toArray()
    			]);
    		}
    		else {
                if($soluong == 0){
                    $errors[] = 'Số lượng phải lớn hơn không';
                    return Response::json(['success'=>false, 'errors'=>$errors]);
                }

    			DB::table('san_pham')->where('masp',$masp)->update(['soluong'=>$soluong]);

    			return Response::json(['success'=>true]);
    		}
    	}
    }

/*----------------------Xóa ảnh phụ của sản phẩm------------------------------*/
    public function getXoaAnhSanPham(){
        if(Request::ajax()){
            $maanh = Request::get('maanh');

            $anh = DB::table('anh_sanpham')->where('maanh',$maanh)->first();
            if(!empty($anh)) {
                //Lấy ảnh trong thư mục ra
                $img1 = 'public/anh-sanpham/'.$anh->tenanh;
                $img2 = 'public/anh-sanpham-trungbinh/'.$anh->tenanh;
                $img3 = 'public/anh-sanpham-nho/'.$anh->tenanh;

                //Xóa ảnh trong thư mục
                if(File::exists($img1)){
                    File::delete($img1);
                }
                if(File::exists($img2)){
                    File::delete($img2);
                }
                if(File::exists($img3)){
                    File::delete($img3);
                }

                //Xóa ảnh trong csdl
                DB::table('anh_sanpham')->where('maanh',$maanh)->delete();

                return Response::json(['success'=>true]);
            }            
        }
    }

/*----------------------Xóa sản phẩm-------------------------------*/
    public function postXoaSanPham(){
        if(Request::ajax()){
            $masp = Request::get('masp');

            //Xóa ảnh phụ trong bảng ảnh sản phẩm
            $img_phu = DB::table('anh_sanpham')->where('masp',$masp)->get();
            if(!empty($img_phu)){
                foreach ($img_phu as $val) {
                    //Xóa ảnh phụ trong 3 thư mục
                    $duongdan1 = 'public/anh-sanpham/'.$val->tenanh;
                    $duongdan2 = 'public/anh-sanpham-trungbinh/'.$val->tenanh;
                    $duongdan3 = 'public/anh-sanpham-nho/'.$val->tenanh;

                    if(File::exists($duongdan1)){
                        File::delete($duongdan1);
                    }
                    if(File::exists($duongdan2)){
                        File::delete($duongdan2);
                    }
                    if(File::exists($duongdan3)){
                        File::delete($duongdan3);
                    }

                    //Xóa ảnh phụ trong csdl
                    DB::table('anh_sanpham')->where('masp',$val->maanh)->delete();
                }
            }

            //Xóa ảnh chính trong 3 thư mục
            $img_chinh = DB::table('san_pham')->where('masp',$masp)->first();
            $duongdan_chinh1 = 'public/anh-sanpham/'.$img_chinh->anh;
            $duongdan_chinh2 = 'public/anh-sanpham-trungbinh/'.$img_chinh->anh;
            $duongdan_chinh3 = 'public/anh-sanpham-nho/'.$img_chinh->anh;
            if(File::exists($duongdan_chinh1)){
                File::delete($duongdan_chinh1);
            }
            if(File::exists($duongdan_chinh2)){
                File::delete($duongdan_chinh2);
            }
            if(File::exists($duongdan_chinh3)){
                File::delete($duongdan_chinh3);
            }

            //Xóa sản phẩm trong bảng sản phẩm
            DB::table('san_pham')->where('masp',$masp)->delete();

        return Response::json(['success'=>true]);
        }
    }


}
