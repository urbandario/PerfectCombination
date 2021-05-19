<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'user_id',
        'type',
        'recipes_id',
        'price',
        'thumbnail',
        'description',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    
    /**
     * Get the exercises of the training.
     */
    public function exercises()
    {
        return $this->belongsToMany('App\Models\Exercise','training_exercises');
    }

    /**
     * Get recipe for training
     * 
     * @return [type]
     */
    public function recipe()
    {
        return $this->belongsTo('App\Models\Recipe')->get();
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
        return '/training/'.$this->id.'/'.$cleanName;
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
        return '/edit/training/'.$this->id.'/'.$cleanName;
    }
}
