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
        Schema::create('produk', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama');
            $table->integer('harga_jual_default')->default(0)->nullable();
            $table->string('slug')->default('')->nullable();
            $table->string('satuan')->default('')->nullable();
            $table->string('berat')->default(0)->nullable();
            $table->string('status')->nullable()->default('Aktif'); //Aktif/Nonaktif login
            // field temp total_produk dari jml table produk_detail
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
        Schema::dropIfExists('produk');
    }
};
