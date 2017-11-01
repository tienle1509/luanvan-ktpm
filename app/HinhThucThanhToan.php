<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HinhThucThanhToan extends Model
{
    protected $table = 'hinhthuc_thanhtoan';
    public $timestamps = false;

    protected $fillable = [
    	'mahttt', 'tenhttt', 'motahttt'
    ];
}
