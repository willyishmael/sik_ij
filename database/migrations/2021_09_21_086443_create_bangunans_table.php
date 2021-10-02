<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBangunansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bangunans', function (Blueprint $table) {
            $table->id();
            $table->string("nomor_bangunan");
            $table->string("nama_pemilik");
            $table->string("nik_pemilik")->unique();
            $table->foreignId("kelurahan_id")->constrained('kelurahans');
            $table->string("lingkungan");
            $table->string("alamat");
            $table->decimal("koordinat_x");
            $table->decimal("koordinat_y");
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('rumahs');
    }
}
