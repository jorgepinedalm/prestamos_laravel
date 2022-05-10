<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEstadoTarjetaTable extends Migration {

	public function up()
	{
		Schema::create('estado_tarjeta', function(Blueprint $table) {
			$table->id();
			$table->timestamps();
			$table->softDeletes();
			$table->string('descripcion', 255);
		});
	}

	public function down()
	{
		Schema::drop('estado_tarjeta');
	}
}