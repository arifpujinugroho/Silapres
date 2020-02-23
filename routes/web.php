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

Route::get('/', 'GuestController@index')->name('home');
Route::post('authlogin', 'GuestController@Masuk');
Route::get('presensi', 'GuestController@Presensi');
Route::get('inputpresensi', 'GuestController@InputPresensi');


Route::get('cek', function () {
        return \Carbon\Carbon::now()->toDateTimeString();
});

Route::group(['middleware' => ['auth']], function () {
        Route::get('event', 'AuthController@Event');
        Route::get('listevent', 'AuthController@ListEvent');
        Route::get('event/{kunci}', 'AuthController@DaftarHadir');
        Route::get('listdaftarhadir', 'AuthController@ListDaftarHadir');
        Route::get('cekdb', 'AuthController@CekDB');

        Route::post('addevent', 'AuthController@AddEvent');
        Route::post('editevent', 'AuthController@EditEvent');
    });

Route::get('keluar', function () {
    Auth::logout();
    return redirect('/')->with('login','logout');
});
