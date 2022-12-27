<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user')->nullable();
            $table->string('nip');
            $table->string('nama');
            $table->enum('jk', ['Laki - Laki', 'Perempuan']);
            $table->string('jabatan');
            $table->string('status');
            $table->string('gol');
            $table->string('alamat');
            $table->integer('pimpinan')->nullable();
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
        Schema::dropIfExists('employees');
    }
}
