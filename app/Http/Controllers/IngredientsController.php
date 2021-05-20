<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use App\Models\Recipe;
use Illuminate\Http\Request;
use Image;

class IngredientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('partials.modals.create_ingredient');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ingredient = new Ingredient();

        $ingredient->name = $request->name;
        $ingredient->calorie = $request->calorie;
        $ingredient->description = $request->description;
        $ingredient->save();

        if($request->hasFile('thumbnail')){
            $thumbnail = $request->file('thumbnail');
            $filename = time() . '.' . $thumbnail->getClientOriginalExtension();
            Image::make($thumbnail)->resize(300, 300)->save( public_path('/img/ingredients/' . $filename ) );
            $ingredient->thumbnail = $filename;
            $ingredient->save();
        }

        toast('Ingredient added!','success','top-right')->showCloseButton();
        return redirect('/create_recipe');
    }

    public function seeIngredients(Request $request)
    {
        $recipe = Recipe::find($request->id);
        return view('partials.modals.see_ingredients')->with('recipe',$recipe);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ingredients  $ingredients
     * @return \Illuminate\Http\Response
     */
    public function show(Ingredient $ingredients)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ingredients  $ingredients
     * @return \Illuminate\Http\Response
     */
    public function edit(Ingredient $ingredients)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ingredients  $ingredients
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ingredient $ingredients)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ingredients  $ingredients
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ingredient $ingredients)
    {
        //
    }
}
