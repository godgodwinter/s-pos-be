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
        Schema::create('label_produk', function (Blueprint $table) {
            $table->bigIncrements('id');
            // $table->string('nama');
            // $table->text('desc')->nullable();
            // $table->string('photo')->nullable();
            // $table->string('prefix')->nullable();
            // $table->string('parrent_id')->nullable();
            $table->string('label_id')->nullable();
            $table->string('produk_id')->nullable();
            $table->string('status')->nullable()->default('Aktif');
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
        Schema::dropIfExists('label_produk');
    }
};
