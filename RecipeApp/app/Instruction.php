<?php

namespace RecipeApp;

use Illuminate\Database\Eloquent\Model;

class Instruction extends Model
{
	/*
	 * Get the recipe that this instruction belongs to.
	 */
	 public function recipe()
	 {
		 return $this->belongsTo('RecipeApp\Recipe');
	 }
}
