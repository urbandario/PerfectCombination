<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);
Route::get('/waiting_admin_approval', 'PageController@showWaitAdminApproval')->name('waiting_admin_approval');

Route::middleware('admin')->group(function () {
    Route::get('/check_trainers', 'AdminController@showCheckTrainers')->name('check_trainers');
    Route::post('/trainer_request_count', 'AdminController@getCountTrainerRequest')->name('trainer_request_count');
    Route::post('/approve_trainer', 'AdminController@updateApproveTrainer')->name('approve_trainer');
    Route::post('/disapprove_trainer', 'AdminController@updateDisapproveTrainer')->name('disapprove_trainer');
    Route::get('/admin_home', 'AdminController@index')->name('admin_home');
});

Route::get('/home', 'HomeController@index')->name('home');

// User routes
Route::get('/profile', 'UserController@index')->name('profile')->middleware('verified');
Route::post('/update_avatar', 'UserController@updateAvatar')->name('update_avatar');
Route::post('/update_biography', 'UserController@updateBiography')->name('update_biography');

Route::get('/training/{training_id}/{name}','TrainingsController@showTraining');
Route::get('/trainings','TrainingsController@showAll')->name('trainings');

Route::get('/see_recipe','RecipesController@seeRecipe')->name('see_recipe');
Route::get('/see_ingredients','IngredientsController@seeIngredients')->name('see_ingredients');
Route::get('/recipes','RecipesController@showAll')->name('recipes');

// Contact routes


// Trainer routes
Route::middleware('trainer')->group(function(){
    // Training routes
    Route::get('/training_list','TrainingsController@index')->name('training_list');
    Route::get('/create_training','TrainingsController@create')->name('create_training');
    Route::post('/create_training','TrainingsController@store')->name('create_training');
    Route::get('/edit/training/{training_id}/{name}','TrainingsController@edit');
    Route::post('/delete_training','TrainingsController@destroy')->name('delete_training');
    Route::post('/update_training','TrainingsController@update')->name('update_training');

    // Exercises routes
    Route::get('/exercise_list','ExercisesController@index')->name('exercise_list');
    Route::get('/create_exercise','ExercisesController@create')->name('create_exercise');
    Route::post('/create_exercise','ExercisesController@store')->name('create_exercise');
    Route::get('/edit/exercise/{exercise_id}/{name}','ExercisesController@edit');
    Route::post('/delete_exercise','ExercisesController@destroy')->name('delete_exercise');
    Route::post('/update_exercise','ExercisesController@update')->name('update_exercise');

    // Recipes routes
    Route::get('/recipe_list','RecipesController@index')->name('recipe_list');
    Route::get('/create_recipe','RecipesController@create')->name('create_recipe');
    Route::post('/create_recipe','RecipesController@store')->name('create_recipe');
    Route::get('/edit/recipe/{recipe_id}/{name}','RecipesController@edit');
    Route::post('/delete_recipe','RecipesController@destroy')->name('delete_recipe');
    Route::post('/update_recipe','RecipesController@update')->name('update_recipe');

    // Ingredient routes
    Route::get('/ingredient_list','IngredientsController@index')->name('ingredient_list');
    Route::get('/create_ingredient','IngredientsController@create')->name('create_ingredient');
    Route::post('/create_ingredient','IngredientsController@store')->name('create_ingredient');
    Route::get('/edit/ingredient/{ingredient_id}/{name}','IngredientsController@edit');
    Route::post('/delete_ingredient','IngredientsController@destroy')->name('delete_ingredient');
    Route::post('/update_ingredient','IngredientsController@update')->name('update_ingredient');
});
