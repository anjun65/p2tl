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
        Schema::create('trafo_not_langsungs', function (Blueprint $table) {
            $table->id();

            $table->foreignId('form1s_id')->constrained('form1s')->onDelete('cascade')->onUpdate('cascade');
            $table->string('trafoct_merk');
            $table->string('trafoct_cls');
            $table->string('trafoct_rasio');
            $table->string('trafoct_burden');
            $table->string('trafopt_merk');
            $table->string('trafopt_cls');
            $table->string('trafopt_rasio');
            $table->string('trafopt_burden');

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
        Schema::dropIfExists('trafo_not_langsungs');
    }
};
