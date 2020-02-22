<?php
use Illuminate\Support\Facades\Crypt;
use App\Model\DBMHS;
use App\Model\Dosen;
use App\Model\Identitas;


function CekMhs($noid){
    $cekbase = DBMHS::wherenim_mahasiswa($noid)->orWhere('email_mahasiswa','=',$noid)->join('arifpujin_pkm_v3.prodi', 'prodi.id', '=', 'db_mahasiswa.id_prodi_mahasiswa')->count();
    if ($cekbase > 0) {
        $mhs = DBMHS::wherenim_mahasiswa($noid)->orWhere('email_mahasiswa','=',$noid)->join('arifpujin_pkm_v3.prodi', 'prodi.id', '=', 'db_mahasiswa.id_prodi_mahasiswa')->first();
        $usr = new Identitas();
        $usr->nama = $mhs->nama_mahasiswa;
        $usr->no_identitas = $mhs->nim_mahasiswa;
        $usr->email = $mhs->email_mahasiswa;
        $usr->jenis_kelamin = $mhs->jns_kel_mahasiswa;
        $usr->instansi = $mhs->nama_prodi.' - '.$mhs->jenjang_prodi;
        $usr->status = "Mahasiswa";
        $usr->save();

        return "ada";
    } else {
        return "";
    }
}

function CekDsn($noid){
    $cekdsn = Dosen::wherenip_dosen($noid)->orWhere('email_dosen','=',$noid)->orWhere('nidk_dosen','=',$noid)->orWhere('nidn_dosen','=',$noid)->count();
    if ($cekdsn > 0) {
        $dsn = Dosen::wherenip_dosen($noid)->orWhere('email_dosen','=',$noid)->orWhere('nidk_dosen','=',$noid)->orWhere('nidn_dosen','=',$noid)->first();
        $usr = new Identitas();
        $usr->nama = $dsn->nama_dosen;
        $usr->no_identitas = $dsn->nip_dosen;
        $usr->nidk = $dsn->nidk_dosen;
        $usr->nidn = $dsn->nidn_dosen;
        $usr->email = $dsn->email_dosen;
        $usr->jenis_kelamin = $dsn->jns_kel_dosen;
        $usr->instansi = "Universitas Negeri Yogyakarta";
        $usr->level = "Dosen";
        $usr->save();
        return "ada";
    } else {
        return "";
    }
}

