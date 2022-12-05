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
        Schema::create('penutup_mcbs', function (Blueprint $table) {
            $table->id();

            $table->foreignId('form1s_id')->constrained('form1s')->onDelete('cascade')->onUpdate('cascade');
            $table->boolean('peralatan')->default(0); 
            $table->boolean('segel')->default(0);
            $table->string('nomor_tahun_kode_segel');
            $table->string('keterangan');
            $table->string('post_peralatan')->default(0);
            $table->string('post_segel')->default(0);
            $table->string('post_nomor_tahun_kode_segel');
            $table->string('post_keterangan');
            $table->string('keterangan_pemeriksaan');

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
        Schema::dropIfExists('penutup_mcbs');
    }
};
