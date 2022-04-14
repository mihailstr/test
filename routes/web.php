<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Page1;
use App\Http\Controllers\Page2;
use App\Http\Controllers\Page3;

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

Route::get('/page1', Page1::class);

Route::get('/page2', Page2::class);

Route::get('/page3', Page3::class);

Route::get('/page3/{id}', function ($id) {
	return Page3::change($id);
});

Route::post('/page3/{id}', function (Request $request, $id) {
	return Page3::save($request, $id);
});

Route::get('/page3/delete/{id}', function ($id) {
	return Page3::dsdelete($id);
});

Route::get('/page3/close/{id}', function ($id) {
	return Page3::dsclose($id);
});

Route::post('/page3/close/{id}', function (Request $request, $id) {
	return Page3::dsclosesave($request, $id);
});

