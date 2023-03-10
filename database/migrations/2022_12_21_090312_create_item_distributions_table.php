<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemDistributionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_distributions', function (Blueprint $table) {
            $table->id();
            $table->integer('id_barang');
            $table->date('tanggal');
            $table->string('kondisi_barang')->nullable();
            $table->integer('jumlah_barang');
            $table->enum('status', ['masuk', 'keluar']);
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
        Schema::dropIfExists('item_distributiongs');
    }
}
