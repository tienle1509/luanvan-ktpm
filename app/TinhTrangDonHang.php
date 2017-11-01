<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TinhTrangDonHang extends Model
{
    protected $table = 'tinhtrang_donhang';
    public $timestamps = false;

    protected $fillable = [
    	'mattdh', 'tenttdh'
    ];
}
