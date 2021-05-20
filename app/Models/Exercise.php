<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'image',
        'user_id',
        'video',
        'description',
    ];

    /**
     * Get all the trainings from the exercise.
     */
    public function trainings()
    {
        return $this->belongsToMany('App\Models\Training','training_exercises');
    }

    /**
     * Get the ingredients of the recipe.
     */
    public function trainingsGet()
    {
        return $this->belongsToMany('App\Models\Exercise','training_exercises','exercise_id','training_id')->get();
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
        return '/exercise/'.$this->id.'/'.$cleanName;
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
        return '/edit/exercise/'.$this->id.'/'.$cleanName;
    }
}
