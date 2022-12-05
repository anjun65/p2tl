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
        Schema::create('pengukuran_not_langsungs', function (Blueprint $table) {
            $table->id();

            $table->foreignId('form1s_id')->constrained('form1s')->onDelete('cascade')->onUpdate('cascade');
            $table->string('arus_primer_r');
            $table->string('arus_primer_s');
            $table->string('arus_primer_t');
            $table->string('arus_sekunder_r');
            $table->string('arus_sekunder_s');
            $table->string('arus_sekunder_t');
            $table->string('ratio_r');
            $table->string('ratio_s');
            $table->string('ratio_t');
            $table->string('akurasi_r');
            $table->string('akurasi_s');
            $table->string('akurasi_t');
            $table->string('voltase_primer_r');
            $table->string('voltase_primer_s');
            $table->string('voltase_primer_t');
            $table->string('cos_r');
            $table->string('cos_s');
            $table->string('cos_t');
            $table->string('akurasi_kwh_meter');
            $table->string('keterangan');
            
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
        Schema::dropIfExists('pengukuran_not_langsungs');
    }
};
