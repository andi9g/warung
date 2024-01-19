<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Warung extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('databarang', function (Blueprint $table) {
            $table->bigIncrements('iddatabarang');
            $table->string("namabarang");
            $table->string("satuan")->nullable();
            $table->double("harga");
            $table->timestamps();
        });
        
        Schema::create('pembelian', function (Blueprint $table) {
            $table->bigIncrements('idpembelian');
            $table->integer("iddatabarang");
            $table->date("tanggalmasuk");
            $table->integer("jumlah");
            $table->timestamps();
        });

        Schema::create('penjualan', function (Blueprint $table) {
            $table->bigIncrements('idpenjualan');
            $table->integer("iddatabarang");
            $table->date("tanggalkeluar");
            $table->integer("jumlah");
            $table->double("harga");
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
        //
    }
}
