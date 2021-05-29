<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\Training;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $trainings = Training::all()->take(6);
        $usersCounter = User::all()->count();
        $recipesCounter = Recipe::all()->count();
        $trainingsCounter = Training::all()->count();
        return view('home')->with(['trainings'=>$trainings,'usersCounter'=>$usersCounter,'recipesCounter'=>$recipesCounter,'trainingsCounter'=>$trainingsCounter]);
    }
    
}
