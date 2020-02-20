<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('encrypt_validate');
            $table->enum('level',['Admin','Mahasiswa','Operator']);
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert(array(
			array('name' => 'Kemahasiswaan','email' =>'kemahasiswaan@uny.ac.id', 'email_verified_at' => new \DateTime(), 'password' => Hash::make('tanyapakmuiz'),'encrypt_validate' => Crypt::encrypt(customCrypt('tanyapakmuiz','e')) ,'level' => 'Admin'),
        ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
