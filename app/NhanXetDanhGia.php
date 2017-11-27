<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NhanXetDanhGia extends Model
{
    protected $table = 'nhanxet_danhgia';
    public $timestamps = false;

    protected $fillable = [
    	'manxdg', 'tieudenx', 'noidungnx', 'saodg', 'thoigiannxdg', 'masp', 'makh'
    ];

}
