<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCobradorRutaTable extends Migration {

	public function up()
	{
		Schema::create('cobrador_ruta', function(Blueprint $table) {
			$table->id();
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('cobrador_ruta');
	}
}