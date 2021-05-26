<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FavoriteTraining extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 
        'training_id'
    ];

    /**
     * Get the training.
     */
    public function users()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * Get the exercise.
     */
    public function trainings()
    {
        return $this->belongsTo('App\Models\Training');
    }
}
