<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_tahun');
            $table->text('keys_event')->nullable();
            $table->text('validate_event');
            $table->string('tgl_event');
            $table->bigInteger('creator_event');
            $table->string('nama_event');
            $table->string('lokasi_event');
            $table->string('tipe_event');
            $table->string('penanggung_jawab')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event');
    }
}
