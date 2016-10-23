<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstructionsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('instructions', function(Blueprint $table)
		{
			//$table->increments('id');
			$table->string('instructionid')->primary();
			$table->integer('ordernum');
			$table->string('text');
			$table->string('recipe_id')->nullable();
			$table->foreign('recipe_id')->references('recipeid')->on('recipes')->onDelete('cascade');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('instructions', function($table)
		{
			$table->dropForeign('instructions_recipe_id_foreign');
		});
		Schema::dropIfExists('instructions');
	}
}
