<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Merujan99\LaravelVideoEmbed\Facades\LaravelVideoEmbed;
use Illuminate\Support\Facades\Auth;

class ExercisesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exercises = Exercise::where('user_id', Auth::id())->cursorPaginate(5);
        return view('trainer.exercise_list')->with('exercises',$exercises);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $exercise = new Exercise;

        $exercise->name = $request->name;
        $exercise->description = $request->description;
        $exercise->user_id = auth()->user()->id;
        $url = $request->url;
        $whitelist = ['YouTube'];

        if (LaravelVideoEmbed::parse($url, $whitelist) == null){
            return back()->withErrors(trans('swal.urlInputFormat'));
        }

        $iframe = LaravelVideoEmbed::parse($url, $whitelist);

        preg_match('~embed/(.*?)\?~', $iframe, $output);
        $url = $output[1];

        $exercise->video = $url;

        if($request->hasFile('thumbnail')){
            $thumbnail = $request->file('thumbnail');
            $filename = time() . '.' . $thumbnail->getClientOriginalExtension();
            Image::make($thumbnail)->resize(200, 200)->save( public_path('/img/exercise/' . $filename ) );
            $exercise->thumbnail = $filename;
            $exercise->save();
        }

        $exercise->save();
        toast('Exercise added!','success','top-right')->showCloseButton();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Exercises  $exercises
     * @return \Illuminate\Http\Response
     */
    public function show(Exercise $exercises)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Exercises  $exercises
     * @return \Illuminate\Http\Response
     */
    public function edit(Exercise $exercises)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Exercises  $exercises
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Exercise $exercises)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Exercises  $exercises
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $exercise = Exercise::find($request->id);

        $exercise->delete();

        toast('Exercise is deleted!','success','top-right')->showCloseButton();
        return 200;
    }
}
