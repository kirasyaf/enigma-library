<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->timestamps();
        });
    }

    // masalah e cuma  tadi, database migrasinya ga runtut , kaarna pas dari awal au coba add itu gabisa nyesuaiin
    // coba kamu runtutuin dulu sesuai youtube dama klo bisa jangan pake add_ gituan soalnya bikin bingung
    // lgsg aja model e, klo misal kepepet gabisa nanti ta kasi yang udh jadi
    // tinggal kamu tambahin fitur, cuma salah di bagian migrations doang kok ga harus sampe ngulang dr nol

    //tpi aku itu udh sesuai sama tutornya, jdii entah migrasinya urut apa engga, ak jg , itu youtube nya ada git nya ga

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
