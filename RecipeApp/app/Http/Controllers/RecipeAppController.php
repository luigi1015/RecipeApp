<?php

namespace RecipeApp\Http\Controllers;

use Illuminate\Http\Request;

use RecipeApp\Http\Requests;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;
use Auth;
use Log;
use RecipeApp\Recipe;
use RecipeApp\User;

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
		$loggedInUser = Auth::user();

		//Check to make sure this can get info about the logged in user, which it should because of the middleware enforcing login. If it can't find info, there's a problem.
		if( empty($loggedInUser) )
		{
			//Can't get info about the logged in user, may want to give an error.
			return view('recipe');
		}

		$recipeUser = User::where('username', $username)->first();

		//Check to make sure this can get info about the user referenced by $username. If it can't find info, there's a problem. For example, the username might be spelled wrong.
		if( empty($recipeUser) )
		{
			//Can't get info about the user referenced by $username, may want to give an error.
			return view('recipe');
		}

		$recipe = Recipe::where([
			['owneruser_id', '=', $recipeUser->userid],
			['userfriendlyid', '=', $userfriendlyid],
			])->with('owneruser')->first();

		//Check to make sure this can get info about the recipe. If it can't find info, there's a problem. For example, the userfriendlyid might be spelled wrong.
		if( empty($recipe) )
		{
			//Can't get info about the recipe, may want to give an error.
			return view('recipe');
		}

		//Check to make sure the logged in user has access to the recipe. Specically (for now at least), check if the logged in user is the owner of the recipe or the recipe is public.
		if( ($recipeUser->userid == $loggedInUser->userid) or ($recipe->public == true) )
		{
			return view('recipe')->with('recipe', $recipe);
		}
		else
		{
			//The user doesn't have acces, may want to give an error.
			return view('recipe');
		}
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
