<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClienteTable extends Migration {

	public function up()
	{
		Schema::create('cliente', function(Blueprint $table) {
			$table->id();
			$table->timestamps();
			$table->softDeletes();
			$table->string('identificacion', 20)->unique();
			$table->string('nombres', 255);
			$table->string('lastname', 255);
			$table->boolean('sex');
			$table->date('birthdate')->nullable();
			$table->string('address', 255)->nullable();
			$table->string('phone', 20)->nullable();
			$table->string('cellphone', 20);
			$table->text('GPS_location')->nullable();
			$table->boolean('state')->default(1);
		});
	}

	public function down()
	{
		Schema::drop('cliente');
	}
}