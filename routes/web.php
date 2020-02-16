<?php
Route::get('optimize', function () {
    \Artisan::call('optimize:clear');
    return view('error.optimize',['title' => '(◠‿◕)']);
});

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
    return view('guest.front');
});

