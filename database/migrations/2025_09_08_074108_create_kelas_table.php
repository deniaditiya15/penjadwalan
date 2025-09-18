<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKelasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('kelas', function (Blueprint $table) {
            $table->id();
            $table->string('kelas'); // Nama kelas, contoh: X IPA 1
            $table->string('nip'); // NIP walikelas
            $table->string('nama_walikelas'); // Nama guru walikelas
            $table->integer('jumlah_siswa')->nullable(); // Opsional
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
        Schema::dropIfExists('kelas');
    }
}
