<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Acara;
use Auth;
use Validator;
use DB;
use Crypt;

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

    public function AddEvent(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'date' => 'required|date',
            'location' => 'required',
        ]);

        if ($validator->fails()) {
            // return redirect()->back()->with('validator', 'failed');
            return response()->json(['error' => 'Not authorized.'],403);
        }

        DB::beginTransaction();
        try {
            $a = new Acara();
            $a->nama_event = $request->get('name');
            $a->tgl_event = $request->get('date');
            $a->lokasi_event = $request->get('location');
            $a->penanggung_jawab = $request->get('pic');
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
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('validator', 'failed');
        }

        DB::beginTransaction();
        try {
            $a = Acara::whereid(Crypt::decryptString(customCrypt($request->get('key'),'d')))->first();
            $a->nama_event = $request->get('name');
            $a->tgl_event = $request->get('date');
            $a->lokasi_event = $request->get('location');
            $a->penanggung_jawab = $request->get('pic');
            $a->validate_event = customCrypt(Crypt::encryptString('date'),'e');
            $a->save();

            DB::commit();
                return 1;
        } catch (\Exception $e) {
                DB::rollback();
                return response()->json(['error' => 'Not authorized.'],403);
        }
    }
}
