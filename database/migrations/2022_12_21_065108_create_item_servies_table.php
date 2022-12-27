<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemServiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_servies', function (Blueprint $table) {
            $table->id();
            $table->integer('id_barang');
            $table->double('jumlah_barang');
            $table->string('kondisi_barang');
            $table->date('tgl_masuk');
            $table->date('tgl_servis');
            $table->date('tgl_keluar');
            $table->string('status_servis');
            $table->string('jenis_servis');
            $table->double('harga_servis');
            $table->string('keterangan');
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
        Schema::dropIfExists('item_servies');
    }
}
