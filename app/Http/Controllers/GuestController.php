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
use Carbon;
use App\Model\Peserta;

class GuestController extends Controller
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
        $kunci = $request->get('kunci');
        if($kunci == "" || $kunci == null){
            return redirect()->back()->with('event','error');
        }else{
            try {
                $id = customCrypt($kunci,'d');
            } catch (\Exception $e) {
                return response()->json(['error' => 'Not authorized.'],403);
            }
            $cek = Acara::whereid($id)->count();
            if($cek > 0){
                $e = Acara::whereid($id)->firstOrFail();
                $tglnya = Crypt::decryptString(customCrypt(Acara::whereid($id)->first()->validate_event,'d'));
                $hariini = \Carbon\Carbon::now()->toDateString();
                if($tglnya == $hariini){
                    return view('guest.absen',compact('e'));
                }else{
                    $p = Acara::whereid($id)->select('nama_event','tgl_event')->firstOrFail();
                    return view('error.nottoday',compact('p'));
                }
            }else{
                return redirect()->back()->with('event','error');
            }
        }
    }
}
