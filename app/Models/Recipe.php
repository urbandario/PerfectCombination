<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'way_of_making',
        'thumbnail',
    ];

    /**
     * Get the ingredients of the recipe.
     */
    public function ingredients()
    {
        return $this->belongsToMany('App\Models\Ingredient','recipe_ingredients');
    }
}
