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
        Schema::table('produk', function (Blueprint $table) {
            $table->text('desc')->nullable();
        });
        Schema::table('label', function (Blueprint $table) {
            $table->string('status')->nullable()->default('Aktif');
        });
        Schema::table('images', function (Blueprint $table) {
            $table->string('status')->nullable()->default('Aktif');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('produk', function ($table) {
            $table->dropColumn('desc');
        });
        Schema::table('label', function ($table) {
            $table->dropColumn('status');
        });
        Schema::table('images', function ($table) {
            $table->dropColumn('status');
        });
    }
};
