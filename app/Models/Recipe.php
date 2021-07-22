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

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    
    /**
     * Get the ingredients of the recipe.
     */
    public function ingredientsGet()
    {
        return $this->belongsToMany('App\Models\Ingredient','recipe_ingredients','recipe_id','ingredient_id')->get();
    }

    /**
     * Get the ingredients of the recipe.
     */
    public function ingredients()
    {
        return $this->belongsToMany('App\Models\Ingredient','recipe_ingredients');
    }

    public function totalCalories()
    {
        return $this->ingredientsGet()->sum('calorie');
    }

    public function trainings()
    {
        return $this->hasMany('App\Models\Training');
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
        return '/recipe/'.$this->id.'/'.$cleanName;
    }

    /**
     *  Get a "clean" url string,
     *  an training route with the training id and name
     *  without spaces and special characters
     *
     * @return string
     */
    public function getCleanUrlRecipeTrainings()
    {
        $name = str_replace(' ', '-', mb_strtolower($this->name));
        $name = iconv('UTF-8', 'ISO-8859-1//TRANSLIT//IGNORE', $name);
        $cleanName = preg_replace('/[^A-Za-z0-9\-]/', '', $name);
        return '/recipe_trainings/'.$this->id.'/'.$cleanName;
    }

     /**
     *  Get a "clean" url for edit string,
     *  an training route with the training id and name
     *  without spaces and special characters
     *
     * @return string
     */
    public function getManageCleanUrl()
    {
        $name = str_replace(' ', '-', mb_strtolower($this->name));
        $name = iconv('UTF-8', 'ISO-8859-1//TRANSLIT//IGNORE', $name);
        $cleanName = preg_replace('/[^A-Za-z0-9\-]/', '', $name);
        return '/edit/recipe/'.$this->id.'/'.$cleanName;
    }
}
