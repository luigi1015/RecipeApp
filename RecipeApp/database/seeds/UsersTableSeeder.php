<?php

use Illuminate\Database\Seeder;
use RecipeApp\Http\Controllers\RecipeAppController;
use Carbon\Carbon;

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
			'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
		]);
	}
}
