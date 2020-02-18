<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Crypt;
use Hash;
use App\Model\User;
use App\Model\DBMHS;
use App\Model\DBPKM;
use App\Model\Dosen;
use App\Model\Identitas;
use App\Model\Acara;
use App\Model\Peserta;

class HomeController extends Controller
{
    //
    public function Index()
    {
        if(Auth::check()){
            return view('users.dashboard');
        }else{
            return view('guest.front');
        }
    }

    public function Masuk(Request $request)
    {
        if (Auth::attempt(['email' => $request->get('username'), 'password' => $request->get('password')])) {
            $user = User::find(Auth::id());
            //cek password harus enskripsi lagi atau tidak
            if (Hash::needsRehash($user->password)) {
                $password = Hash::make($request->get('password'));
                $user->password = $password;
                $user->save();
            }
                return redirect('/');
        } else {
            return redirect('/')->with('login', 'error');
        }
    }

    public function Presensi(Request $request)
    {
        $id = customCrypt(Crypt::decryptString($request->get('kunci')),'d');
        $cek = Acara::whereid($id)->count();
        if($cek > 0){
            $validate = customCrypt(Crypt::decryptString(Acara::whereid($id)->first()->validate_event),'d');
            $now = \Carbon\Carbon::now()->toDateString();
            if($validate == $now){
                $e = Acara::whereid($id)->fisrt();
                return view('guest.absen',compact('e'));
            }else{
                return redirect()->back()->with('event','expired');
            }
        }else{
            return redirect()->back()->with('event','nothing');
        }
    }
}
