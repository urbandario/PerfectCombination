<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'trainer',
        'admin',
        'avatar',
        'biography',
        'phone',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function trainings()
    {
        return $this->hasMany('App\Models\Training');
    }

    /**
     * Get users that favored the training.
     */
    public function favoriteTrainings()
    {
        return $this->belongsToMany('App\Models\Training','favorite_trainings');
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
        return '/trainer/'.$this->id.'/'.$cleanName;
    }
}
