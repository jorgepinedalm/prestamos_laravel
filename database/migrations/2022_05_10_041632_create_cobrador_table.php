<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCobradorTable extends Migration {

	public function up()
	{
		Schema::create('cobrador', function(Blueprint $table) {
			$table->timestamps();
			$table->softDeletes();
			$table->string('placa_vehiculo', 50)->nullable();
			$table->bigInteger('user_id')->primary()->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('cobrador');
	}
}