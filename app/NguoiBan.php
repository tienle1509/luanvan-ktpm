<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NguoiBan extends Model
{
    protected $table = 'nguoi_ban';
    public $timestamps = false;

    protected $fillable = [
    	'manb', 'tennb', 'tengianhang', 'email', 'matkhau', 'sodienthoai', 'diachi'
    ];

    protected $hidden = [
    	'matkhau', 'remember_token',
    ];
}
