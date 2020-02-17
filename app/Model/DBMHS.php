<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DBMHS extends Model
{
    //
    protected $connection = 'masterdb';
    protected $table ="db_mahasiswa";
}
