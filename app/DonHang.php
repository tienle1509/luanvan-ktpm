<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DonHang extends Model
{
    protected $table = 'don_hang';
    public $timestamps = false;

    protected $fillable = [
    	'madh', 'ngaydat', 'tongtien', 'trangthai', 'makh', 'maql',
    	'mattdh', 'mahttt'
    ];
}
