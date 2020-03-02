<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Acara;
use App\Model\Peserta;
use App\Model\Tahun;
use App\Model\Identitas;
use Response;
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
        return Peserta::select('peserta.id as idnya','nama','no_identitas','email','instansi','status','datang','pulang')->join('identitas','identitas.id','peserta.id_user')->where('peserta.id_event','=',$kunci)->get();
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
        try {
            $idevent = Crypt::decrypt($request->get('event'));
        }catch(\Exception $e) {
            return response()->json(['error' => 'Not authorized.'],403);
        }
        $input = $request->get('input');
        $iden = Identitas::whereno_identitas($input)->orWhere('email','=',$input)->orWhere('nidn','=',$input)->orWhere('nidk','=',$input)->count();
        if($iden == 1){
            $data = Identitas::select('id','nama','no_identitas','email','jenis_kelamin','instansi','status')->where('no_identitas','=',$input)->orWhere('email','=',$input)->orWhere('nidn','=',$input)->orWhere('nidk','=',$input)->first();
            $cek = Peserta::where('id_event','=',$idevent)->where('id_user','=',$data->id)->first();
            if(is_object($cek)){
                return 1;
            }else{
                $kode = Crypt::encrypt(Identitas::whereno_identitas($input)->orWhere('email','=',$input)->orWhere('nidn','=',$input)->orWhere('nidk','=',$input)->first()->id);
                $response = new \stdClass();
                $response->isi = $data;
                $response->kode = $kode;
                return Response::json($response);
            }
        }else{
            $cekMhs = CekMhs($input);
            if($cekMhs == "ada"){
                $data = Identitas::select('nama','no_identitas','email','jenis_kelamin','instansi','status')->where('no_identitas','=',$input)->orWhere('email','=',$input)->orWhere('nidn','=',$input)->orWhere('nidk','=',$input)->first();
                $kode = Crypt::encrypt(Identitas::whereno_identitas($input)->orWhere('email','=',$input)->orWhere('nidn','=',$input)->orWhere('nidk','=',$input)->first()->id);
                $response = new \stdClass();
                $response->isi = $data;
                $response->kode = $kode;
                return Response::json($response);
            }else{
                $cekDsn = CekDsn($input);
                if($cekDsn == "ada"){
                    $data = Identitas::select('nama','no_identitas','email','jenis_kelamin','instansi','status')->where('no_identitas','=',$input)->orWhere('email','=',$input)->orWhere('nidn','=',$input)->orWhere('nidk','=',$input)->first();
                    $kode = Crypt::encrypt(Identitas::whereno_identitas($input)->orWhere('email','=',$input)->orWhere('nidn','=',$input)->orWhere('nidk','=',$input)->first()->id);
                    $response = new \stdClass();
                    $response->isi = $data;
                    $response->kode = $kode;
                    return Response::json($response);
                }else{
                    return "";
                }
            }
        }
    }

    public function AddPeserta(Request $request)
    {
        $iduser  = Crypt::decrypt($request->get('user'));
        $idevent = customCrypt($request->get('event'),'d');

        $cek = Peserta::where('id_user','=',$iduser)->where('id_event','=',$idevent)->first();
        if(is_object($cek)){
            return "";
        }else{
            $peserta = new Peserta();
            $peserta->id_event = $idevent;
            $peserta->id_user = $iduser;
            $peserta->save();

            return 1;
        }
    }

    public function HapusPeserta(Request $request)
    {
        $iduser  = $request->get('user');
        try {
            $idevent = Crypt::decrypt($request->get('event'));
        }catch(\Exception $e) {
            return response()->json(['error' => 'Not authorized.'],403);
        }

        Peserta::where('id','=',$iduser)->where('id_event','=',$idevent)->delete();
    }
}
