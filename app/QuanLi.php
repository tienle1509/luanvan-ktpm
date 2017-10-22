<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuanLi extends Model
{
    protected $table = 'nguoi_quanli';
    public $timestamps = false;

    protected $fillable = [
    	'maql', 'tenql', 'email', 'matkhau'
    ];

    protected $hidden = [
    	'matkhau', 'remember_token',
    ];
}
