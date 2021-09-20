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
            $table->string("kelurahan");
            $table->string("kecamatan");
            $table->string("kabupaten_kota"); 
            $table->string("provinsi");
            $table->string("alamat_kantor");  
            $table->string("telepon_kelurahan");  
            $table->string("email_kelurahan");  
            $table->foreignId("lurah_id")->constrained('perangkat_kelurahans');
            $table->foreignId("sekretaris_id")->constrained('perangkat_kelurahans');
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
        Schema::dropIfExists('kelurahans');
    }
}
