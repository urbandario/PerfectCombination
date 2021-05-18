<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingExercise extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'training_id', 
        'exercise_id'
    ];

    /**
     * Get the training.
     */
    public function training()
    {
        return $this->belongsTo('App\Models\Training');
    }

    /**
     * Get the exercise.
     */
    public function exercise()
    {
        return $this->belongsTo('App\Models\Exercise');
    }
}
