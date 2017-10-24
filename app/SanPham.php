<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SanPham extends Model
{
    protected $table = 'san_pham';
    public $timestamps = false;

    protected $fillable = [
    	'masp', 'tensp', 'dongia', 'soluong', 'xuatxu', 'baohanh', 'dophangiaimanhinh',
    		'kichthuocmanhinh', 'hedieuhanh', 'mausac', 'cameratruoc', 'camerasau', 
    		'bonhotrong', 'dungluongpin', 'mota', 'anh', 'luotxem', 'trangthai', 'manb', 'madm'
    ];

/*    public function anhsanpham(){
    	return $this->hasMany('App\AnhSanPham');
    }

    public function danhmuc(){
    	return $this->belongsTo('App\DanhMucSanPham');
    }

    public function nguoiban(){
    	return $this->belongsTo('App\NguoiBan');
    }   */
}
