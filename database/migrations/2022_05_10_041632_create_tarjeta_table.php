<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTarjetaTable extends Migration {

	public function up()
	{
		Schema::create('tarjeta', function(Blueprint $table) {
			$table->id();
			$table->timestamps();
			$table->softDeletes();
			$table->bigInteger('prestamo_id')->unsigned();
			$table->bigInteger('cobrador_id')->unsigned();
			$table->float('valor_cobrado');
			$table->float('valor_a_cobrar')->nullable();
			$table->datetime('fecha_registro');
			$table->bigInteger('estado_tarjeta_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('tarjeta');
	}
}