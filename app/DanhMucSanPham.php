<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DanhMucSanPham extends Model
{
    protected $table = 'danhmuc_sanpham';
    public $timestamps = false;

    protected $fillable = [
    	'madm', 'tendanhmuc'
    ];
}
