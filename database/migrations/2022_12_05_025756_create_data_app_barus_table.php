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
        Schema::create('data_app_barus', function (Blueprint $table) {
            $table->id();

            $table->foreignId('form1s_id')->constrained('form1s')->onDelete('cascade')->onUpdate('cascade');
            $table->string('merk');
            $table->string('no_reg');
            $table->string('no_seri');
            $table->string('tahun_pembuatan');
            $table->string('class');
            $table->string('konstanta');
            $table->string('rating_arus');
            $table->string('tegangan_nominal');
            $table->string('stand_kwh_meter');
            $table->string('jenis_pembatas');
            $table->string('alat_pembatas_merk');
            $table->string('rating_arus_2');
            
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
        Schema::dropIfExists('data_app_barus');
    }
};
