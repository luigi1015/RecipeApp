<?php

use Illuminate\Database\Seeder;
use RecipeApp\Http\Controllers\RecipeAppController;
use Carbon\Carbon;

class InstructionsTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$recipe = \RecipeApp\Recipe::where('name','Test Recipe 01')->first();

		$uuid = RecipeAppController::getUUID( 'instructions', 'instructionid' );
		DB::table('instructions')->insert([
			'instructionid' => $uuid,
			'ordernum' => 1,
			'text' => 'Test Recipe Instruction 01',
			'recipe_id' => $recipe->recipeid,
			'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
		]);

		$uuid = RecipeAppController::getUUID( 'instructions', 'instructionid' );
		DB::table('instructions')->insert([
			'instructionid' => $uuid,
			'ordernum' => 2,
			'text' => 'Test Recipe Instruction 02',
			'recipe_id' => $recipe->recipeid,
			'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
		]);

		$uuid = RecipeAppController::getUUID( 'instructions', 'instructionid' );
		DB::table('instructions')->insert([
			'instructionid' => $uuid,
			'ordernum' => 3,
			'text' => 'Test Recipe Instruction 03',
			'recipe_id' => $recipe->recipeid,
			'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
		]);
	}
}
