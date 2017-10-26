<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KhuyenMai extends Model
{
    protected $table = 'khuyen_mai';
    public $timestamps = false;

    protected $fillable = [
    	'makm', 'ngaybd', 'ngaykt', 'handangki', 'tenkm', 'mota', 'chietkhau', 'anhkm', 'maql'
    ];
}
