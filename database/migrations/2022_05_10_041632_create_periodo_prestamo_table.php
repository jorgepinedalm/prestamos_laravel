<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePeriodoPrestamoTable extends Migration {

	public function up()
	{
		Schema::create('periodo_prestamo', function(Blueprint $table) {
			$table->id();
			$table->timestamps();
			$table->softDeletes();
			$table->string('descripcion', 255);
		});
	}

	public function down()
	{
		Schema::drop('periodo_prestamo');
	}
}