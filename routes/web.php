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

Route::get('/', 'HomeController@index')->name('home');
Route::post('authlogin', 'HomeController@Masuk');
Route::get('presensi', 'HomeController@Presensi');

Route::get('cek', function () {
        return \Carbon\Carbon::now()->toDateString();
});

Route::group(['middleware' => ['auth']], function () {
        Route::get('event', 'AuthController@Event');
        Route::get('listevent', 'AuthController@ListEvent');
});

Route::get('keluar', function () {
        Auth::logout();
        return redirect()->route('home');
});
