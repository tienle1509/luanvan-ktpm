<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChiTietDonHang extends Model
{
    protected $table = 'chitiet_donhang';
    public $timestamps = false;

    protected $fillable = [
    	'madh', 'masp', 'soluongct'
    ];
}
