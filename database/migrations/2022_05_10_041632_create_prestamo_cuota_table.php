<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePrestamoCuotaTable extends Migration {

	public function up()
	{
		Schema::create('prestamo_cuota', function(Blueprint $table) {
			$table->id();
			$table->timestamps();
			$table->softDeletes();
			$table->bigInteger('user_id')->unsigned();
			$table->bigInteger('cliente_id')->unsigned();
			$table->bigInteger('prestamo_id')->unsigned();
			$table->bigInteger('estado_prestamo_cuota_id')->unsigned();
			$table->bigInteger('periodo_prestamo_id')->unsigned();
			$table->float('valor_prestamo');
			$table->float('tasa_interes');
			$table->float('valor_cuota');
			$table->float('valor_pagado');
			$table->integer('cuotas');
			$table->datetime('fecha_pago_cuota')->nullable();
			$table->datetime('fecha_pago_programado');
			$table->datetime('fecha_inicio_prestamo');
			$table->string('usuario_creador', 255)->nullable();
			$table->string('usuario_editor', 255)->nullable();
			$table->string('observacion', 255)->nullable();
		});
	}

	public function down()
	{
		Schema::drop('prestamo_cuota');
	}
}