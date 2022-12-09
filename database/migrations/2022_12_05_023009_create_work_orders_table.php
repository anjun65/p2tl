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
        Schema::create('work_orders', function (Blueprint $table) {
            $table->id();
            $table->string('users_id');
            $table->string('id_pelanggan');
            $table->string('nama_pelanggan');
            $table->string('latitude');
            $table->string('longitude');
            $table->string('alamat');
            $table->string('tarif');
            $table->string('daya');
            $table->string('rbm');
            $table->string('lgkh');
            $table->string('fkm');
            $table->string('keterangan_p2tl');

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
        Schema::dropIfExists('work_orders');
    }
};
