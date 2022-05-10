<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('cobrador', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('prestamo', function(Blueprint $table) {
			$table->foreign('cliente_id')->references('id')->on('cliente')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('prestamo', function(Blueprint $table) {
			$table->foreign('periodo_prestamo_id')->references('id')->on('periodo_prestamo')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('cliente_imagenes', function(Blueprint $table) {
			$table->foreign('cliente_id')->references('id')->on('cliente')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('prestamo_estado_prestamo', function(Blueprint $table) {
			$table->foreign('prestamo_id')->references('id')->on('prestamo')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('prestamo_estado_prestamo', function(Blueprint $table) {
			$table->foreign('estado_prestamo_id')->references('id')->on('prestamo_estado_prestamo')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('prestamo_estado_prestamo', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('tarjeta', function(Blueprint $table) {
			$table->foreign('prestamo_id')->references('id')->on('prestamo')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('tarjeta', function(Blueprint $table) {
			$table->foreign('cobrador_id')->references('user_id')->on('cobrador')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('tarjeta', function(Blueprint $table) {
			$table->foreign('estado_tarjeta_id')->references('id')->on('estado_tarjeta')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
	}

	public function down()
	{
		Schema::table('cobrador', function(Blueprint $table) {
			$table->dropForeign('cobrador_user_id_foreign');
		});
		Schema::table('prestamo', function(Blueprint $table) {
			$table->dropForeign('prestamo_cliente_id_foreign');
		});
		Schema::table('prestamo', function(Blueprint $table) {
			$table->dropForeign('prestamo_periodo_prestamo_id_foreign');
		});
		Schema::table('cliente_imagenes', function(Blueprint $table) {
			$table->dropForeign('cliente_imagenes_cliente_id_foreign');
		});
		Schema::table('prestamo_estado_prestamo', function(Blueprint $table) {
			$table->dropForeign('prestamo_estado_prestamo_prestamo_id_foreign');
		});
		Schema::table('prestamo_estado_prestamo', function(Blueprint $table) {
			$table->dropForeign('prestamo_estado_prestamo_estado_prestamo_id_foreign');
		});
		Schema::table('prestamo_estado_prestamo', function(Blueprint $table) {
			$table->dropForeign('prestamo_estado_prestamo_user_id_foreign');
		});
		Schema::table('tarjeta', function(Blueprint $table) {
			$table->dropForeign('tarjeta_prestamo_id_foreign');
		});
		Schema::table('tarjeta', function(Blueprint $table) {
			$table->dropForeign('tarjeta_cobrador_id_foreign');
		});
		Schema::table('tarjeta', function(Blueprint $table) {
			$table->dropForeign('tarjeta_estado_tarjeta_id_foreign');
		});
	}
}