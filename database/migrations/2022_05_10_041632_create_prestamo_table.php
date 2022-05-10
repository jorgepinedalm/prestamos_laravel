<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePrestamoTable extends Migration {

	public function up()
	{
		Schema::create('prestamo', function(Blueprint $table) {
			$table->id();
			$table->timestamps();
			$table->softDeletes();
			$table->bigInteger('cliente_id')->unsigned();
			$table->float('valor_prestamo');
			$table->float('tasa_interes');
			$table->integer('cuotas');
			$table->datetime('fecha_prestamo')->nullable();
			$table->datetime('fecha_inicio_prestamo');
			$table->string('usuario_creador', 255)->nullable();
			$table->string('usuario_editor', 255)->nullable();
			$table->bigInteger('periodo_prestamo_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('prestamo');
	}
}