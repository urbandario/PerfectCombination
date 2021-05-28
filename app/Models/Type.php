<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    public function trainings()
    {
        return $this->hasMany('App\Models\Training');
    }

    /**
     *  Get a "clean" url string,
     *  an training route with the type id and name
     *  without spaces and special characters
     *
     * @return string
     */
    public function getCleanUrl()
    {
        $name = str_replace(' ', '-', mb_strtolower($this->name));
        $name = iconv('UTF-8', 'ISO-8859-1//TRANSLIT//IGNORE', $name);
        $cleanName = preg_replace('/[^A-Za-z0-9\-]/', '', $name);
        return '/type/'.$this->id.'/'.$cleanName;
    }
}
