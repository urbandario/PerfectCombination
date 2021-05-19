<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'calorie',
        'thumbnail',
        'description',
    ];

    /**
     * Get the ingredients of the recipe.
     */
    public function recipesGet()
    {
        return $this->belongsToMany('App\Models\Recipe','recipe_ingredients','ingredient_id','recipe_id')->get();
    }

    /**
     * Get the ingredients of the recipe.
     */
    public function recipes()
    {
        return $this->belongsToMany('App\Models\Recipe','recipe_ingredients');
    }
}
