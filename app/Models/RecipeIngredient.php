<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;


class RecipeIngredient extends Pivot
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'recipe_id', 
        'ingredient_id'
    ];

    /**
     * Get the training.
     */
    public function recipe()
    {
        return $this->belongsTo('App\Models\Recipe');
    }

    /**
     * Get the exercise.
     */
    public function ingredient()
    {
        return $this->belongsTo('App\Models\Ingredient');
    }
}
