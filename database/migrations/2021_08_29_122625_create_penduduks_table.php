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
            $table->id();
            $table->string("nama");
            $table->foreignId('rumah_id');
            $table->string("tempat_lahir");
            $table->date("tanggal_lahir");
            $table->string("nik")->unique();
            $table->string("no_telp")->unique();
            $table->string("email")->unique();
            $table->boolean("jenis_kelamin");
            $table->string("status_pernikahan");
            $table->foreignId("kepala_keluarga_id");
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
