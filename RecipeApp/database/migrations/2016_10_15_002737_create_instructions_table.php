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
		Schema::table('instructions', function($table)
		{
			$table->dropForeign('instructions_recipeid_foreign');
		});
		Schema::dropIfExists('instructions');
	}
}
