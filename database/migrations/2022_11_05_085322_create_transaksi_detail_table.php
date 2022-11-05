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
        Schema::create('transaksi_detail', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('transaksi_id')->nullable();
            $table->string('produk_id')->nullable();
            $table->string('harga_terjual')->nullable(); //harga dari produk restok
            $table->string('jml')->nullable();
            $table->string('diskon')->nullable();
            $table->string('harga_akhir')->nullable(); //harga setelah didiskon
            $table->string('jml_berat')->nullable(); //berat satuan x jml
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
        Schema::dropIfExists('transaksi_detail');
    }
};
