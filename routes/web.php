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

Route::get('cek', function () {
        return \Carbon\Carbon::now()->toDateString();
});

Route::group(['middleware' => ['auth']], function () {
        Route::get('event', 'AuthController@Event');
        Route::get('listevent', 'AuthController@ListEvent');
        Route::get('event/{kunci}', 'AuthController@DaftarHadir');
        Route::get('listdaftarhadir', 'AuthController@ListDaftarHadir');

        Route::post('addevent', 'AuthController@AddEvent');
        Route::post('editevent', 'AuthController@EditEvent');
    });

Route::get('keluar', function () {
    Auth::logout();
    return redirect('/')->with('login','logout');
});
