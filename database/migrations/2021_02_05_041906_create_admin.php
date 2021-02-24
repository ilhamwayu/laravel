<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdmin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama', 50);
            $table->enum('jk', ['LAKI-LAKI','PEREMPUAN']);
            $table->string('tmp_lahir', 50);
            $table->date('tgl_lahir');
            $table->char('no_hp', 12);
            $table->string('email', 50);
            $table->string('idjabatan', 12);
            $table->text('alamat');
            $table->string('idakun', 100);
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
        Schema::dropIfExists('admin');
    }
}
