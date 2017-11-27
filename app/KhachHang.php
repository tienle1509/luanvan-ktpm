<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KhachHang extends Model
{
    protected $table = 'khach_hang';
    public $timestamps = false;

    protected $fillable = [
    	'makh', 'tennguoidung', 'tenkh', 'email', 'matkhau', 'sodienthoai',
    	'diachigiaohang', 'thanhvien', 'ngaytao'
    ];
}
