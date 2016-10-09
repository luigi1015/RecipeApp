<?php

use Illuminate\Database\Seeder;
use RecipeApp\Http\Controllers\RecipeAppController;

class UsersTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$uuid = RecipeAppController::getUUID( 'users', 'userid' );
		 DB::table('users')->insert([
			'userid' => $uuid,
			'name' => 'Jeff',
			'username' => 'luigi1015',
			'email' => 'test@test.test',
			'password' => bcrypt('supermario'),
			'active' => 1,
		 ]);
	}
}
