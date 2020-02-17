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
use App\Model\Event;
use App\Model\Peserta;

class HomeController extends Controller
{
    //
    public function Index()
    {
        if(Auth::check()){
            return redirect('/');
        }else{
            return view('guest.front');
        }
    }

    public function Presensi($key)
    {
        $id = Crypt::decryptString($key);
        $cek = Event::whereid($id)->count();
        if($cek > 0){
            $e = Event::whereid($id)->fisrt();
            return view('guest.absen',compact('e'));
        }else{
            return redirect()->back()->with('event','nothing');
        }
    }
}
