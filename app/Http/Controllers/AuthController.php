<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Acara;
use App\Model\Peserta;
use App\Model\Tahun;
use App\Model\Identitas;
use Auth;
use Validator;
use DB;
use Crypt;

class AuthController extends Controller
{
    public function Event(Request $request)
    {
        if($tahun = $request->get('tahun')){
            $cek=Tahun::whereid($tahun = $request->get('tahun'))->firstOrFail();
            return view('users.event',compact('tahun'));
        }else{
            $thn = Tahun::all();
            return view('users.pilihtahun',compact('thn'));
        }
    }

    public function ListEvent(Request $request)
    {
        $tahun = $request->get('tahun');
        $idme = Auth::user()->id;
        return Acara::select('keys_event','tipe_event','tgl_event','nama_event','lokasi_event','penanggung_jawab')->where('creator_event','=',$idme)->where('id_tahun','=', $tahun)->get();
    }

    public function DaftarHadir($kunci)
    {
        $idme = Auth::user()->id;
        $e = Acara::whereid(customCrypt($kunci,'d'))->where('creator_event','=',$idme)->firstOrFail();
        if($e->tipe_event == 1){
            return view('users.daftarhadir',compact('e'));
        }else{
            return view('users.daftarhadirkhusus',compact('e'));
        }
    }

    public function ListDaftarHadir(Request $request)
    {
        $kunci  = customCrypt($request->get('kunci'),'d');
        return Peserta::select('nama','no_identitas','email','instansi','status','datang','pulang')->join('identitas','identitas.id','peserta.id_user')->where('peserta.id_event','=',$kunci)->get();
    }

    public function AddEvent(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'date' => 'required|date',
            'location' => 'required',
            'tipe' => 'required',
        ]);

        if ($validator->fails()) {
            // return redirect()->back()->with('validator', 'failed');
            return response()->json(['error' => 'Not authorized.'],403);
        }

        $tahun = Tahun::wheretahun(date('Y', strtotime($request->get('date'))))->firstOrFail();

        DB::beginTransaction();
        try {
            $a = new Acara();
            $a->id_tahun = $tahun->id;
            $a->nama_event = $request->get('name');
            $a->tgl_event = $request->get('date');
            $a->lokasi_event = $request->get('location');
            $a->penanggung_jawab = $request->get('pic');
            $a->tipe_event = $request->get('tipe');
            $a->creator_event = Auth::user()->id;
            $a->validate_event = customCrypt(Crypt::encryptString($request->get('date')),'e');
            $a->save();

            $b = Acara::whereid($a->id)->first();
            $b->keys_event = customCrypt($a->id,'e');
            $b->save();

            DB::commit();
                return 1;
        } catch (\Exception $e) {
                DB::rollback();
                return response()->json(['error' => 'Not authorized.'],403);
        }
    }

    public function EditEvent(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'key' => 'required',
            'name' => 'required',
            'date' => 'required|date',
            'location' => 'required',
            'tipe' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Not authorized.'],403);
        }
        $tahun = Tahun::wheretahun(date('Y', strtotime($request->get('date'))))->firstOrFail();

        DB::beginTransaction();
        try {
            $a = Acara::whereid(customCrypt($request->get('key'),'d'))->first();
            $a->id_tahun = $tahun->id;
            $a->nama_event = $request->get('name');
            $a->tgl_event = $request->get('date');
            $a->lokasi_event = $request->get('location');
            $a->penanggung_jawab = $request->get('pic');
            $a->tipe_event = $request->get('tipe');
            $a->validate_event = customCrypt(Crypt::encryptString($request->get('date')),'e');
            $a->save();

            DB::commit();
                return 1;
        } catch (\Exception $e) {
                DB::rollback();
                return response()->json(['error' => 'Not authorized.'],403);
        }
    }
    public function CekDB(Request $request)
    {
        $input = $request->get('input');
        $iden = Identitas::whereno_identitas($input)->orWhere('email','=',$input)->orWhere('nidn','=',$input)->orWhere('nidk','=',$input)->count();
        if($iden == 1){
            return Identitas::whereno_identitas($input)->orWhere('email','=',$input)->orWhere('nidn','=',$input)->orWhere('nidk','=',$input)->first();
        }else{
            $cekMhs = CekMhs($input);
            if(is_object($cekMhs)){
                return Identitas::whereno_identitas($input)->orWhere('email','=',$input)->orWhere('nidn','=',$input)->orWhere('nidk','=',$input)->first();
            }else{
                $cekDsn = CekDsn($input);
                if(is_object($cekDsn)){
                    return Identitas::whereno_identitas($input)->orWhere('email','=',$input)->orWhere('nidn','=',$input)->orWhere('nidk','=',$input)->first();
                }else{
                    return "";
                }
            }
        }
    }
}
