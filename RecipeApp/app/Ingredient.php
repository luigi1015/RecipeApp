<?php

namespace RecipeApp;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
	/*
	 * Get the recipe that this ingredient belongs to.
	 */
	 public function recipe()
	 {
		 return $this->belongsTo('RecipeApp\Recipe');
	 }
}
