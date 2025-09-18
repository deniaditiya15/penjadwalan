<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJadwalTable extends Migration
{
    public function up()
    {
        Schema::create('jadwal', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kelas_id');
            $table->unsignedBigInteger('mapel_id');
            $table->unsignedBigInteger('guru_id');
            $table->string('hari'); // Senin, Selasa, dst
            $table->time('waktu_mulai');   // contoh: 07:30
            $table->time('waktu_selesai'); // contoh: 08:15
            $table->string('semester')->nullable();
            $table->timestamps();

            // Relasi
            $table->foreign('kelas_id')
                  ->references('id')->on('kelas')
                  ->onDelete('cascade');

            $table->foreign('mapel_id')
                  ->references('id')->on('mapels')
                  ->onDelete('cascade');

            $table->foreign('guru_id')
                  ->references('id')->on('gurus')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('jadwal');
    }
}
