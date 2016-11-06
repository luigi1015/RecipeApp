<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIngredientsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ingredients', function(Blueprint $table)
		{
			//$table->increments('id');
			$table->string('ingredientid')->primary();
			$table->integer('amount')->nullable();
			$table->string('unit')->nullable();
			$table->string('ingredientName');
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
		Schema::table('ingredients', function($table)
		{
			$table->dropForeign('ingredients_recipe_id_foreign');
		});
		Schema::dropIfExists('ingredients');
	}
}
