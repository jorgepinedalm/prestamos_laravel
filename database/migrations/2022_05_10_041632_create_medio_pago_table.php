<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMedioPagoTable extends Migration {

	public function up()
	{
		Schema::create('medio_pago', function(Blueprint $table) {
			$table->id();
			$table->timestamps();
			$table->softDeletes();
			$table->string('descripcion', 255);
		});
	}

	public function down()
	{
		Schema::drop('medio_pago');
	}
}