<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnhSanPham extends Model
{
    protected $table = 'anh_sanpham';
    public $timestamps = false;

    protected $fillable = [
    	'maanh', 'tenanh', 'masp'
    ];
}
