<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pintu_gardu_not_langsungs', function (Blueprint $table) {
            $table->id();

            $table->foreignId('form1s_id')->constrained('form1s')->onDelete('cascade')->onUpdate('cascade');
            $table->boolean('peralatan');
            $table->boolean('segel');
            $table->string('nomor_tahun_kode_segel');
            $table->string('keterangan');
            $table->boolean('post_pemeriksaan_peralatan');
            $table->boolean('post_segel');
            $table->string('post_nomor_tahun_kode_segel');
            $table->string('post_keterangan');

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
        Schema::dropIfExists('pintu_gardu_not_langsungs');
    }
};
