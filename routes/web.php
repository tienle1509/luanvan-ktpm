<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});






//QUẢN LÍ
Route::group(['prefix'=>'quanli'], function(){

	//Quản lí sản phẩm
	Route::get('ql-sanpham', function (){
		return view('quanli.sanpham.sanpham_home');
	});

	Route::group(['prefix'=>'ql-sanpham'], function(){
		Route::get('duyet-sanpham', function () {
			return view('quanli.sanpham.duyet_sanpham');
		});
		Route::get('sanpham-trongngay', function () {
			return view('quanli.sanpham.sanpham_trongngay');
		});
		Route::get('tatca-sanpham', function () {
			return view('quanli.sanpham.tatca_sanpham');
		});
		Route::get('chitiet-sanpham', function () {
			return view('quanli.sanpham.chitiet_sanpham');
		});
	});
});




//------------------------------------------------------------
Route::get('demo', function () {
	return view('quanli_home');
});

Route::get('demo1', function () {
	return view('quanli.sanpham');
});

Route::get('demo2', function () {
	return view('quanli.sanpham.sanpham_home');
});