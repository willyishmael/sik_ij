<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenduduksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penduduks', function (Blueprint $table) {
            $table->engine = 'innoDB';
            $table->id();
            $table->string("nama");
            $table->string('bangunan_id')->index();
            $table->foreign('bangunan_id')->references('id')->on('bangunans');
            $table->string("tempat_lahir");
            $table->date("tanggal_lahir");
            $table->string("nomor_kk")->unique();
            $table->string("nik")->unique();
            $table->string("nomor_telepon");
            $table->string("email")->nullable();
            $table->string("jenis_kelamin");
            $table->string("status_pernikahan");
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
        Schema::dropIfExists('penduduks');
    }
}
