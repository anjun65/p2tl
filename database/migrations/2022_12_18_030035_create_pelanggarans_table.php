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
        Schema::create('pelanggarans', function (Blueprint $table) {
            $table->id();

            $table->foreignId('works_id')->constrained('work_orders')->onDelete('cascade')->onUpdate('cascade');
            $table->string('path_ba_pengambilan_bb');
            $table->string('path_ba_serah_terima_bb')->nullable();
            $table->string('path_image')->nullable();
            $table->string('path_video')->nullable();


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
        Schema::dropIfExists('pelanggarans');
    }
};
