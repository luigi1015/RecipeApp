<?php

use Illuminate\Database\Seeder;
use RecipeApp\Http\Controllers\RecipeAppController;
use Carbon\Carbon;

class RecipesTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$uuid = RecipeAppController::getUUID( 'recipes', 'recipeid' );
		$user = \RecipeApp\User::where('username','luigi1015')->first();
		DB::table('recipes')->insert([
			'recipeid' => $uuid,
			'name' => 'Test Recipe 01',
			'public' => true,
			'owneruserid' => $user->userid,
			'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
		]);
	}
}
