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
			$table->string('text');
			$table->string('recipeid')->nullable();
			$table->foreign('recipeid')->references('recipeid')->on('recipes')->onDelete('cascade');
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
			$table->dropForeign('ingredients_recipeid_foreign');
		});
		Schema::dropIfExists('ingredients');
	}
}
