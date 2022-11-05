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
        Schema::create('transaksi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kodetrans')->nullable();
            $table->string('pelanggan_tipe')->nullable()->default('Nonmember');
            $table->string('transaksi_tipe')->nullable()->default('Offline');
            $table->string('alamat')->nullable()->default('');
            $table->string('telp')->nullable();
            $table->string('status')->nullable()->default('Aktif');
            $table->string('photo_konfirmasi')->nullable()->default('Aktif');
            $table->string('penanggungjawab')->nullable()->default('Aktif'); //kasir
            $table->string('tglbeli')->nullable();
            $table->string('ppn')->nullable(0);
            $table->string('total_bayar')->nullable()->default(0);
            $table->string('dibayar')->nullable()->default(0);
            $table->string('kembalian')->nullable()->default(0);
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
        Schema::dropIfExists('transaksi');
    }
};
