<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecipesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('recipes', function(Blueprint $table)
		{
			//$table->increments('id');
			$table->string('recipeid')->primary();
			$table->string('name');
			$table->boolean('public');
			$table->string('owneruserid')->nullable();
			$table->foreign('owneruserid')->references('userid')->on('users')->onDelete('set null');
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
		Schema::table('recipes', function($table)
		{
			$table->dropForeign('recipes_owneruserid_foreign');
		});
		Schema::dropIfExists('recipes');
	}
}
