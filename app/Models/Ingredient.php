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

    /**
     *  Get a "clean" url string,
     *  an training route with the training id and name
     *  without spaces and special characters
     *
     * @return string
     */
    public function getCleanUrl()
    {
        $name = str_replace(' ', '-', mb_strtolower($this->name));
        $name = iconv('UTF-8', 'ISO-8859-1//TRANSLIT//IGNORE', $name);
        $cleanName = preg_replace('/[^A-Za-z0-9\-]/', '', $name);
        return '/ingredient/'.$this->id.'/'.$cleanName;
    }
}
