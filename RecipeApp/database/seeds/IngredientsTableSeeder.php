<?php

use Illuminate\Database\Seeder;
use RecipeApp\Http\Controllers\RecipeAppController;
use Carbon\Carbon;

class IngredientsTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$recipe = \RecipeApp\Recipe::where('name','Test Recipe 01')->first();

		$uuid = RecipeAppController::getUUID( 'ingredients', 'ingredientid' );
		DB::table('ingredients')->insert([
			'ingredientid' => $uuid,
			'text' => 'Test Recipe Ingredient 01',
			'recipe_id' => $recipe->recipeid,
			'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
		]);

		$uuid = RecipeAppController::getUUID( 'ingredients', 'ingredientid' );
		DB::table('ingredients')->insert([
			'ingredientid' => $uuid,
			'text' => 'Test Recipe Ingredient 02',
			'recipe_id' => $recipe->recipeid,
			'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
		]);

		$uuid = RecipeAppController::getUUID( 'ingredients', 'ingredientid' );
		DB::table('ingredients')->insert([
			'ingredientid' => $uuid,
			'text' => 'Test Recipe Ingredient 03',
			'recipe_id' => $recipe->recipeid,
			'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
		]);
	}
}
