<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Image;

class RecipesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recipes = Recipe::where('user_id', Auth::id())->cursorPaginate(5);
        return view('trainer.recipe_list')->with('recipes',$recipes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ingredients = Ingredient::all();
        return view('trainer.create_recipe')->with('ingredients',$ingredients);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $recipe = new Recipe();

        $recipe->name = $request->name;
        $recipe->way_of_making = $request->way_of_making;
        $recipe->user_id = auth()->user()->id;
        $recipe->save();

        $hidden_ingredient = explode(',',$request->hidden_ingredient);
        $ingredient = Ingredient::whereIn('ingredients.id',$hidden_ingredient)->get();
        $recipe->ingredients()->attach($ingredient);

        if($request->hasFile('thumbnail')){
            $thumbnail = $request->file('thumbnail');
            $filename = time() . '.' . $thumbnail->getClientOriginalExtension();
            Image::make($thumbnail)->resize(300, 300)->save( public_path('/img/recipes/' . $filename ) );
            $recipe->thumbnail = $filename;
            $recipe->save();
        }

        toast('You recipe is ready!','success','top-right')->showCloseButton();
        return redirect('/recipe_list');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Recipes  $recipes
     * @return \Illuminate\Http\Response
     */
    public function show(Recipe $recipes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Recipes  $recipes
     * @return \Illuminate\Http\Response
     */
    public function edit($recipe_id)
    {
        $recipe = Recipe::find($recipe_id);
        $ingredients = Ingredient::all();
        $selectedIngredients =  $recipe->ingredients()->pluck('ingredients.id')->toArray();
        return view('trainer.edit_recipe')->with(['recipe'=>$recipe,'ingredients'=>$ingredients,'selectedIngredients'=>$selectedIngredients]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Recipes  $recipes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Recipe $recipes)
    {
        $recipe = Recipe::find($request->recipe_id);
        $recipe->name = $request->name;
        $recipe->user_id = auth()->user()->id;
        $recipe->way_of_making = $request->way_of_making;
        $recipe->save();

        $hidden_ingredient = str_replace('"', '', str_replace(']', '', str_replace('[', '', $request->hidden_ingredient)));
        $hidden_ingredient = explode(',',$request->hidden_ingredient);
        $ingredient = Ingredient::whereIn('ingredients.id',$hidden_ingredient)->get();
        $recipe->ingredients()->sync($ingredient);

        if($request->hasFile('thumbnail')){
            $thumbnail = $request->file('thumbnail');
            $filename = time() . '.' . $thumbnail->getClientOriginalExtension();
            Image::make($thumbnail)->resize(300, 300)->save( public_path('/img/recipes/' . $filename ) );
            $recipe->thumbnail = $filename;
            $recipe->save();
        }

        toast('You recipe is updated!','success','top-right')->showCloseButton();
        return redirect('/recipe_list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Recipes  $recipes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $recipe = Recipe::find($request->id);

        $recipe->delete();

        toast('Recipe is deleted!','success','top-right')->showCloseButton();
        return 200;
    }
}
