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
			$table->string('userfriendlyid');//For use in stuff like route parameters. Needs to contain only characters that can be put in a URL (i.e. no spaces).
			$table->boolean('public');
			$table->string('owneruser_id')->nullable();
			$table->foreign('owneruser_id')->references('userid')->on('users')->onDelete('set null');
			$table->string('description');
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
			$table->dropForeign('recipes_owneruser_id_foreign');
		});
		Schema::dropIfExists('recipes');
	}
}
