<?php

namespace App\Http\Controllers;

use App\Models\Training;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoritesController extends Controller
{
    /**
     * Returns favorite articles page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $favorites = Auth::user()->favoriteTrainings()->get();

        return view('favorites')->with('favorites',$favorites);
    }

    /**
     * Create FavoriteArticle on user request
     * or delete object record
     *
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse|int
     */
    public function updateFavorite(Request $request)
    {
        if(!$user = Auth::user()){
            return 400;
        }
        $training = Training::find($request->id);

        if (!$user->favoriteTrainings->contains($training->id)){
            $user->favoriteTrainings()->attach($training->id);
            $added = true;
        }
        else {
            $user->favoriteTrainings()->detach($training->id);
            $added = false;
        }

        return ['added' => $added];
    }
}