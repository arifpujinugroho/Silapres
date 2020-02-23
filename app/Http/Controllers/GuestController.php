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


    public function InputPresensi(Request $request)
    {
        $tipe = $request->get('tipe');
        $input = $request->get('input');
        $event = customCrypt($request->get('event'),'d');

        if(CekEvent($event) == 'Ready'){
            // cek identitas
            $identity = Identitas::whereno_identitas($input)->orWhere('email','=',$input)->orWhere('nidn','=',$input)->orWhere('nidk','=',$input)->first();
            if(is_object($identity)){
                if($tipe == "in"){
                    $datang =  DatangEvent($event,$identity->id);
                    if($datang == "Success"){
                        return Peserta::select('nama','instansi','datang','pulang')->where('peserta.id_user','=',$identity->id)->where('peserta.id_event','=',$event)->join('identitas','identitas.id','peserta.id_user')->first();
                    }else{
                        return $datang;
                    }
                }elseif($tipe == "out"){
                    $pulang =  PulangEvent($event,$identity->id);
                    if($pulang == "Success"){
                        return Peserta::select('nama','instansi','datang','pulang')->where('peserta.id_user','=',$identity->id)->where('peserta.id_event','=',$event)->join('identitas','identitas.id','peserta.id_user')->first();
                    }else{
                        return $pulang;
                    }
                }else{
                    return "error";
                }
            }else{
                if(CekMhs($input) == 'ada'){
                    $idmhs = Identitas::whereno_identitas($input)->orWhere('email','=',$input)->orWhere('nidn','=',$input)->orWhere('nidk','=',$input)->first();
                    if($tipe == "in"){
                        $datang =  DatangEvent($event,$idmhs->id);
                        if($datang == "Success"){
                            return Peserta::select('nama','instansi','datang','pulang')->where('peserta.id_user','=',$idmhs->id)->where('peserta.id_event','=',$event)->join('identitas','identitas.id','peserta.id_user')->first();
                        }else{
                            return $datang;
                        }
                    }elseif($tipe == "out"){
                        $pulang =  PulangEvent($event,$idmhs->id);
                        if($pulang == "Success"){
                            return Peserta::select('nama','instansi','datang','pulang')->where('peserta.id_user','=',$idmhs->id)->where('peserta.id_event','=',$event)->join('identitas','identitas.id','peserta.id_user')->first();
                        }else{
                            return $pulang;
                        }
                    }else{
                        return "error";
                    }
                }else{
                    if(CekDsn($input) == 'ada'){
                        $iddsn = Identitas::whereno_identitas($input)->orWhere('email','=',$input)->orWhere('nidn','=',$input)->orWhere('nidk','=',$input)->first();
                        if($tipe == "in"){
                            $datang =  DatangEvent($event,$iddsn->id);
                            if($datang == "Success"){
                                return Peserta::select('nama','instansi','datang','pulang')->where('peserta.id_user','=',$iddsn->id)->where('peserta.id_event','=',$event)->join('identitas','identitas.id','peserta.id_user')->first();
                            }else{
                                return $datang;
                            }
                        }elseif($tipe == "out"){
                            $pulang =  PulangEvent($event,$iddsn->id);
                            if($pulang == "Success"){
                                return Peserta::select('nama','instansi','datang','pulang')->where('peserta.id_user','=',$iddsn->id)->where('peserta.id_event','=',$event)->join('identitas','identitas.id','peserta.id_user')->first();
                            }else{
                                return $pulang;
                            }
                        }else{
                            return "error";
                        }
                    }else{
                        return 'error';
                    }
                }
            }
        }else{
            return 'Denied';
        }
    }


















}
