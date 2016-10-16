<?php

namespace RecipeApp\Http\Controllers;

use Illuminate\Http\Request;

use RecipeApp\Http\Requests;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;
use Auth;
use Log;
use RecipeApp\Recipe;

class RecipeAppController extends Controller
{
	/**
	 * Show the user's recipes.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function getRecipes()
	{
		$recipes = array();
		if( Auth::check() )
		{
			$user = Auth::user();
			$recipes = Recipe::where('owneruser_id', $user->userid)->orderBy('name', 'asc')->with('owneruser')->get();
			//Log::info('Found ' . count($recipes) . ' recipes for user: ' . $user->userid);
		}
		return view('recipes')->with('recipes', $recipes);
	}

	/**
	 * Show the recipe for a given username and userfriendlyid.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function getRecipe( $username, $userfriendlyid )
	{
		return view('recipe');
	}

	/**
	 * Generates a UUID that's not in the $columnName column of the $tableName table.
	 * 
	 * $tableName - the name of the table to check for duplicates
	 * $columnName - the name of the column within the table to check for duplicates
	 */
	public static function getUUID( $tableName, $columnName )
	{
		if( empty($tableName) || empty($columnName) )
		{
			\Log::error('In getUUID( $tableName, $columnName ), either $tableName, "' . $tableName . '", is empty or $columnName, "' . $columnName . '", is empty.' );
			abort(500);
		}
		$uuid = '';
		$iterations = 1;
		do
		{
			//If have gone through this loop more than a hundred times, something's wrong, give an error and abort.
			if( $iterations >= 100 )
			{
				\Log::error('There was a problem generating the UUID, been through the UUID generation block ' . $iterations . ' times.' );
				abort(500);
			}
			else
			{
				$iterations++;
			}

			try
			{
				$uuid = RecipeAppController::getUUIDNoChecks();
			}
			catch( UnsatisfiedDependencyException $e )
			{
				\Log::error('There was a problem generating the UUID: ' . $e.getMessage() .'\n' . $e.getTraceAsString());
				abort(500);
			}
			$recordsWithSameID = \DB::table($tableName)->where($columnName, $uuid);
		}
		while( $recordsWithSameID->count() > 0 );//If a record with the same id is found, create another one.

		return $uuid;
	}

	/**
	 * Generates a UUID.
	 */
	public static function getUUIDNoChecks()
	{
		$uuid = '';

		try
		{
			$uuid = Uuid::uuid4();
		}
		catch( UnsatisfiedDependencyException $e )
		{
			\Log::error('In getUUIDNoChecks(), There was a problem generating the UUID: ' . $e.getMessage() .'\n' . $e.getTraceAsString());
			throw $e;
		}

		return $uuid;
	}
}
