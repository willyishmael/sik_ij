<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRumahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rumahs', function (Blueprint $table) {
            $table->id();
            $table->string("no_rumah");
            $table->foreignId("pemilik_id");
            $table->string("lingkungan");
            $table->string("alamat");
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
        Schema::dropIfExists('rumahs');
    }
}
