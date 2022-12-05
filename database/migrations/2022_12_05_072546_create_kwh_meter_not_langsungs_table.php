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
        Schema::create('kwh_meter_not_langsungs', function (Blueprint $table) {
            $table->id();

            $table->foreignId('form1s_id')->constrained('form1s')->onDelete('cascade')->onUpdate('cascade');
            $table->string('merk');
            $table->string('no_register');
            $table->string('no_seri');
            $table->string('tahun_buat');
            $table->string('konstanta');
            $table->string('class_akurasi');
            $table->string('rating_arus');
            $table->string('tegangan');
            $table->string('lbp');
            $table->string('bp');
            $table->string('kwh_total');
            $table->string('kvArh');

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
        Schema::dropIfExists('kwh_meter_not_langsungs');
    }
};
