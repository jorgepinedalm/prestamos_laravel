<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClienteImagenesTable extends Migration {

	public function up()
	{
		Schema::create('cliente_imagenes', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->text('ID_front');
			$table->text('ID_back');
			$table->text('home_photo');
			$table->text('person_photo');
			$table->bigInteger('cliente_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('cliente_imagenes');
	}
}