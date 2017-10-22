<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use DB;
use Mail;
use App\User;
use Hash;
use App\NguoiBan;
use Auth;

class RegisterNguoiBanController extends Controller
{	
/*---------------Mã người bán tự tăng---------------------*/
	public function maNguoiBan(){
		$ds_manb = DB::table('nguoi_ban')->select('manb')->get();
		$max = 0;

		foreach ($ds_manb as $value) {
			$cat_chuoi = substr($value->manb, 3);
			if($cat_chuoi > $max)
				$max = $cat_chuoi;
		}

		$chuoi_so = $max+1;
		if($chuoi_so < 10){
            $manb = 'NBH00'.$chuoi_so;
        }else{
            $manb = 'NBH0'.$chuoi_so;
        }
        return $manb;
	}


/*-------------------Trang đầu tiên lấy thông tin người bán đăng kí và gửi mail--------------------*/
  /*  public function getDangKyNguoiBan(){
    	return view('auth.dangnhap_ban');
    }   */

    public function postDangKyNguoiBan(Request $request){
    	$v = Validator::make($request->all(), [
    			'txtHoTen'=>'required',
    			'txtEmail'=>'required|email',
    			'txtSDT'=>'required|between:10,11',
    			'txtMatKhau1'=>'required|min:8',
    			'txtMatKhau2'=>'required|same:txtMatKhau1',
    			'txtTenShop'=>'required|min:5'
    		],
    		[
    			'txtHoTen.required'=>'Họ tên không được rỗng',
    			'txtEmail.required'=>'Địa chỉ email không được rỗng',
    			'txtEmail.email'=>'Email không đúng định dạng',
    			'txtSDT.required'=>'Số điện thoại không được rỗng',
    			'txtSDT.between'=>'Số điện thoại không đúng định dạng',    			
    			'txtMatKhau1.required'=>'Mật khẩu không được rỗng',
    			'txtMatKhau1.min'=>'Mật khẩu có ít nhất 8 kí tự',
    			'txtMatKhau2.required'=>'Xác nhận mật khẩu không được rỗng',
    			'txtMatKhau2.same'=>'Không khớp mật khẩu',
    			'txtTenShop.required'=>'Tên shop không được rỗng',
    			'txtTenShop.min'=>'Tên shop có ít nhất 5 kí tự'
    		]);

    	if($v->fails()){
    		return redirect()->back()->withInput($request->except('password'))->withErrors($v->errors());
    	} 

    	//Lấy email trong bảng người bán ra
    	$email = DB::table('nguoi_ban')->select('email')->where('email',$request->txtEmail)->first();
    	

        //Nếu có biến email thì trùng
    	if(!empty($email)){
    		$errors['txtEmail'] = 'Email này đã tồn tại';
    		return redirect()->back()->withInput($request->except('password'))->withErrors($errors);
    	} else {
    		//Truyền dữ liệu qua trang xác nhận mail
    		session_start();
    		$_SESSION['hoten'] = $request->txtHoTen;
    		$_SESSION['email']= $request->txtEmail;
    		$_SESSION['sdt']= $request->txtSDT;
    		$_SESSION['matkhau'] = $request->txtMatKhau1;
    		$_SESSION['tenshop'] = $request->txtTenShop;
    		$_SESSION['maxacnhan'] = random_int(100000,999999);


    		$data = ['maxacnhan'=> $_SESSION['maxacnhan']];

    		//Gửi mail mã xác nhận
    		Mail::send('nguoiban.dangky.giaodien_mail', $data, function($message){
    			$message->from('mobilestore1509@gmail.com','Mobile Store');
    			$message->to($_SESSION['email'])->subject('[MobileStore.vn] Xác thực tài khoản người dùng tại mobilestore.vn');
    		});

    		return redirect('nguoiban/xacthuc-mail'); 
    	}    		
    }

/*--------------------Trang xác thực email nhập vào----------------------------*/
    public function getXacThucMail(){
    	return view('nguoiban.dangky.xacthuc_mail');
    }

    public function postXacThucMail(Request $request){
    	$v = Validator::make($request->all(), [
    			'txtMaXacNhan'=>'required'    			
    		],
    		[
    			'txtMaXacNhan.required'=>'Vui lòng nhập mã xác nhận'
    		]
    		);

    	if($v->fails()){
    		return redirect()->back()->withInput($request->except('password'))->withErrors($v->errors());
    	}

    	session_start();
    	$maxacnhan = $_SESSION['maxacnhan'];

    	if($maxacnhan == $request->txtMaXacNhan){
    		return redirect('nguoiban/dien-thongtin');
    	} else {
    		$errors['txtMaXacNhan'] = 'Mã xác nhận không chính xác';
    		return redirect()->back()->withInput($request->except('password'))->withErrors($errors);
    	}
    }

    //Gửi lại mail
    public function postGuiLạiMail(){
    	session_start();
    	$_SESSION['maxacnhan'] = random_int(100000,999999);


    	$data = ['maxacnhan'=> $_SESSION['maxacnhan']];

    	//Gửi mail mã xác nhận
    	Mail::send('nguoiban.dangky.giaodien_mail', $data, function($message){
    		$message->from('mobilestore1509@gmail.com','Mobile Store');
    		$message->to($_SESSION['email'])->subject('[MobileStore.vn] Xác thực tài khoản người dùng tại mobilestore.vn');
    	});

    	$_SESSION['success_guima'] = 'Đã gửi lại mã xác nhận';

    	return redirect('nguoiban/xacthuc-mail');
    }

/*---------------------Trang điền thông tin địa chỉ---------------------------*/
	public function getDienThongTin(){
		return view('nguoiban.dangky.dien_thongtin');
	}

	public function postDienThongTin(Request $request){
		$v = Validator::make($request->all(), [
			'textareaDiaChi'=>'required'
		],
		[
			'textareaDiaChi.required'=>'Trường địa chỉ không được rỗng !'
		]);

		if($v->fails()){
			return redirect()->back()->withErrors($v->errors());
		}

		session_start();
        
        //Thêm vô bảng người bán
		$nguoiban = new NguoiBan();
		$nguoiban->manb = $this->maNguoiBan();
		$nguoiban->tennb = $_SESSION['hoten'];
		$nguoiban->tengianhang = $_SESSION['tenshop'];
		$nguoiban->email = $_SESSION['email'];
		$nguoiban->matkhau = Hash::make($_SESSION['matkhau']);
		$nguoiban->sodienthoai = $_SESSION['sdt'];
		$nguoiban->diachi = $request->textareaDiaChi;
		$nguoiban->save();


		//Kiểm tra người dùng
        $check_db = DB::table('nguoi_ban')->where('email',$_SESSION['email'])->first();

        if(!empty($check_db)){
            if(Hash::check($_SESSION['matkhau'], $check_db->matkhau)){
                $_SESSION['manb'] = $this->maNguoiBan();

                //Xóa session
                unset($_SESSION['hoten']);
                unset($_SESSION['email']);
                unset($_SESSION['sdt']);
                unset($_SESSION['matkhau']);
                unset($_SESSION['tenshop']);
                unset($_SESSION['maxacnhan']);

                return redirect('nguoiban/ql-sanpham');
            }             
        }
	}

}
