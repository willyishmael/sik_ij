<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKelurahansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kelurahans', function (Blueprint $table) {
            $table->id();
            $table->string("nama_kelurahan");
            $table->unsignedBigInteger("lurah_id");
            $table->unsignedBigInteger("sekretaris_id");
            $table->timestamps();

            $table->foreign("lurah_id")->references("id")->on("penduduks");
            $table->foreign("sekretaris_id")->references("id")->on("penduduks");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kelurahans');
    }
}
