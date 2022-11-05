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
        Schema::create('restok', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kodetrans')->nullable();
            $table->string('namatoko')->nullable();
            $table->string('tglbeli')->nullable();
            $table->string('totalbayar')->nullable();
            $table->string('penanggungjawab')->nullable(); //orang yang membeli
            $table->string('status')->nullable()->default('Aktif'); //Aktif/Nonaktif login
            // temp - jml_barang dari jml produk_detail where restok_id
            $table->softDeletes();
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
        Schema::dropIfExists('restok');
    }
};
