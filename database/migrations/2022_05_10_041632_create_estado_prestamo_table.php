<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEstadoPrestamoTable extends Migration {

	public function up()
	{
		Schema::create('estado_prestamo', function(Blueprint $table) {
			$table->id();
			$table->timestamps();
			$table->softDeletes();
			$table->string('descripcion', 255);
			$table->boolean('estado')->default(1);
		});
	}

	public function down()
	{
		Schema::drop('estado_prestamo');
	}
}