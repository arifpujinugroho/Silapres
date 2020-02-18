<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Acara;
use Auth;

class AuthController extends Controller
{
    public function Event()
    {
        return view('users.event');
    }

    public function ListEvent()
    {
        $idme = Auth::user()->id;
        return Acara::select('keys_event','tgl_event','nama_event','lokasi_event','penanggung_jawab')->where('creator_event','=',$idme)->get();
    }

}
