<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use App\Models\Recipe;
use App\Models\Training;
use App\Models\Type;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Image;

class TrainingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trainings = Training::where('user_id', Auth::id())->get();
        return view('trainer.training_list')->with('trainings',$trainings);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $exercises = Exercise::where('user_id', Auth::id())->get();
        $recipes = Recipe::where('user_id', Auth::id())->get();
        $types = Type::all();
        return view('trainer.create_training')->with(['exercises'=>$exercises,'recipes'=>$recipes,'types'=>$types]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
           'name' => 'required|max:32',
           'type' => 'nullable|max:25|unique:types,name',
           'description' => 'required|max:255',
           'hidden_recipe' => 'nullable',
           'price' => 'nullable',
           'thumbnail' => 'nullable',
           'hidden_exercise'=> 'required',
           'hidden_type' => 'nullable',
        ]);

        $training = new Training();

        if($request->type != null){
            $type = new Type();
            $type->name = $request->type;
            $type->save();
            $training->type_id = $type->id;
        }else{
            $training->type_id = $request->hidden_type;
        }

        $training->name = $request->name;
        $training->user_id = auth()->user()->id;
        $training->recipe_id = $request->hidden_recipe;
        $training->price = $request->price;
        $training->description = $request->description;
        $training->save();

        $hidden_exercise = explode(',',$request->hidden_exercise);
        $exercise = Exercise::whereIn('exercises.id',$hidden_exercise)->get();
        $training->exercises()->attach($exercise);

        if($request->hasFile('thumbnail')){
            $thumbnail = $request->file('thumbnail');
            $filename = time() . '.' . $thumbnail->getClientOriginalExtension();
            Image::make($thumbnail)->resize(300, 300)->save( public_path('/img/trainings/' . $filename ) );
            $training->thumbnail = $filename;
            $training->save();
        }

        toast('You training is ready!','success','top-right')->showCloseButton();
        return redirect('/training_list');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Training  $training
     * @return \Illuminate\Http\Response
     */
    public function showTraining($training_id)
    {
        $training = Training::find($training_id);
        return view('training')->with('training',$training);
    }

    public function showAll()
    {
        $trainings = Training::all();
        return view('trainings')->with('trainings',$trainings);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Training  $training
     * @return \Illuminate\Http\Response
     */
    public function edit($training_id)
    {
        $training = Training::find($training_id);
        $exercises = Exercise::where('user_id', Auth::id())->get();
        $recipes = Recipe::where('user_id', Auth::id())->get();
        $types = Type::all();
        $selectedExercises =  $training->exercises()->pluck('exercises.id')->toArray();
        $selectedType = $training->type_id;
        $selectedRecipes = $training->recipe_id;
        return view('trainer.edit_training')->with(['exercises'=>$exercises,'recipes'=>$recipes,'training'=>$training,'selectedExercises'=>$selectedExercises,'selectedRecipes'=>$selectedRecipes,'types'=>$types,'selectedType'=>$selectedType]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Training  $training
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|max:32',
            'type' => 'nullable|max:25|unique:types,name',
            'description' => 'required|max:255',
            'hidden_recipe' => 'nullable',
            'price' => 'nullable',
            'thumbnail' => 'nullable',
            'hidden_exercise'=> 'required',
            'hidden_type' => 'nullable',
         ]);

        $training = Training::find($request->training_id);

        if($request->type != null){
            $type = new Type();
            $type->name = $request->type;
            $type->save();
            $training->type_id = $type->id;
        }else{
            $training->type_id = $request->hidden_type;
        }
        
        $training->name = $request->name;
        $training->user_id = auth()->user()->id;
        $training->recipe_id = $request->hidden_recipe;
        $training->price = $request->price;
        $training->description = $request->description;
        $training->save();

        $hidden_exercise = str_replace('"', '', str_replace(']', '', str_replace('[', '', $request->hidden_exercise)));
        $hidden_exercise = explode(',',$request->hidden_exercise);
        $exercise = Exercise::whereIn('exercises.id',$hidden_exercise)->get();
        $training->exercises()->sync($exercise);

        if($request->hasFile('thumbnail')){
            $thumbnail = $request->file('thumbnail');
            $filename = time() . '.' . $thumbnail->getClientOriginalExtension();
            Image::make($thumbnail)->resize(300, 300)->save( public_path('/img/trainings/' . $filename ) );
            $training->thumbnail = $filename;
            $training->save();
        }

        toast('You training is updated!','success','top-right')->showCloseButton();
        return redirect('/training_list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Training  $training
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $training = Training::find($request->id);

        $training->delete();

        toast('Training is deleted!','success','top-right')->showCloseButton();
        return 200;
    }
}
