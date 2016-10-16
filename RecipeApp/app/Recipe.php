<?php

namespace RecipeApp;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
	/*
	 * Get the user that owns the recipe.
	 */
	 public function owneruser()
	 {
		 return $this->belongsTo('RecipeApp\User');
	 }
}
