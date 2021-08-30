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
            $table->unsignedBigInteger('rumah_id');
            $table->string("tempat_lahir");
            $table->date("tanggal_lahir");
            $table->string("nik")->unique();
            $table->string("no_telp")->unique();
            $table->string("email")->unique();
            $table->boolean("jenis_kelamin");
            $table->string("status_pernikahan");
            $table->unsignedBigInteger("kepala_keluarga_id");
            $table->timestamps();

            $table->foreign("rumah_id")->references("id")->on("rumahs");
            $table->foreign("kepala_keluarga_id")->references("id")->on("penduduks");
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
