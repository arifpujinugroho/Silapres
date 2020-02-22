<?php

use \Illuminate\Support\HtmlString;
use App\Modal\User;
use App\Modal\DBMHS;
use App\Modal\Dosen;


function CekMhs($noid){
    $cekbase = DBMHS::wherenim_mahasiswa($noid)->orWhereemail_mahasiswa($noid)->first();
    if (is_object($cekbase)) {
        $retval = DBMHS::select('nama_mahasiswa', 'nama_prodi', 'jenjang_prodi', 'jns_kel_mahasiswa')
            ->join('arifpujin_pkm_v3.prodi', 'prodi.id', '=', 'db_mahasiswa.id_prodi_mahasiswa') ///ini harus disesuaikan
            ->where('nim_mahasiswa', '=', $nim)->first();
        $kodenya = Crypt::encryptString($cekbase->email_mahasiswa);
        $usr = new User();
        $usr->username = $cekbase->nim_mahasiswa;
        $usr->password = Hash::make($cekbase->email_mahasiswa);
        $usr->level = "Mahasiswa";
        $usr->save();
        $mhs = new IdentitasMahasiswa();
        $mhs->nim = $cekbase->nim_mahasiswa;
        $mhs->nama = $cekbase->nama_mahasiswa;
        $mhs->email = $cekbase->email_mahasiswa;
        $mhs->jenis_kelamin = $cekbase->jns_kel_mahasiswa;
        $mhs->id_prodi = $cekbase->id_prodi_mahasiswa;
        $mhs->tanggallahir = $cekbase->tgllahir_mahasiswa;
        $mhs->tempatlahir = $cekbase->tmptlahir_mahasiswa;
        $mhs->crypt_token = Crypt::encrypt($cekbase->email_mahasiswa);
        $mhs->id_user = $usr->id;
        $mhs->save();
        $response = new \stdClass();
        $response->isi = $retval;
        $response->kode = $kodenya;
        return Response::json($response);
    } else {
        return $cekbase;
    }
}
