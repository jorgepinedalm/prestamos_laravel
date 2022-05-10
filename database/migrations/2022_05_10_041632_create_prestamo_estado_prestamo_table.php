<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePrestamoEstadoPrestamoTable extends Migration {

	public function up()
	{
		Schema::create('prestamo_estado_prestamo', function(Blueprint $table) {
			$table->id();
			$table->timestamps();
			$table->bigInteger('prestamo_id')->unsigned();
			$table->bigInteger('estado_prestamo_id')->unsigned();
			$table->bigInteger('user_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('prestamo_estado_prestamo');
	}
}