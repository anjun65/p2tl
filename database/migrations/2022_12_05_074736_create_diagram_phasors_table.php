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
        Schema::create('diagram_phasors', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('form1s_id')->constrained('form1s')->onDelete('cascade')->onUpdate('cascade');
            $table->string('hasil_pemeriksaan');
            $table->string('kesimpulan');
            $table->string('tindakan');
            $table->string('barang_bukti');
            $table->string('hari');
            $table->date('tanggal');


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
        Schema::dropIfExists('diagram_phasors');
    }
};
