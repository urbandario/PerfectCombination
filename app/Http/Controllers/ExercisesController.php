<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Merujan99\LaravelVideoEmbed\Facades\LaravelVideoEmbed;
use Illuminate\Support\Facades\Auth;
use Image;

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

        if($request->url != null)
        {
            $url = $request->url;
            $whitelist = ['YouTube'];
    
            if (LaravelVideoEmbed::parse($url, $whitelist) == null){
                return back()->withErrors(trans('swal.urlInputFormat'));
            }
    
            $iframe = LaravelVideoEmbed::parse($url, $whitelist);
    
            preg_match('~embed/(.*?)\?~', $iframe, $output);
            $url = $output[1];
    
            $exercise->video = $url;
        }
        

        if($request->hasFile('thumbnail')){
            $image = $request->file('thumbnail');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(200, 200)->save( public_path('/img/exercise/' . $filename ) );
            $exercise->image = $filename;
            $exercise->save();
        }

        $exercise->save();
        toast('Exercise added!','success','top-right')->showCloseButton();
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Exercises  $exercises
     * @return \Illuminate\Http\Response
     */
    public function edit($exercise_id)
    {
        $exercise = Exercise::find($exercise_id);
        return view('trainer.edit_exercise')->with('exercise',$exercise);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Exercises  $exercises
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $exercise = Exercise::find($request->exercise_id);

        $exercise->name = $request->name;
        $exercise->description = $request->description;
        $exercise->user_id = auth()->user()->id;

        if($request->url != null)
        {
            $url = $request->url;
            $whitelist = ['YouTube'];
    
            if (LaravelVideoEmbed::parse($url, $whitelist) == null){
                return back()->withErrors(trans('swal.urlInputFormat'));
            }
    
            $iframe = LaravelVideoEmbed::parse($url, $whitelist);
    
            preg_match('~embed/(.*?)\?~', $iframe, $output);
            $url = $output[1];
    
            $exercise->video = $url;
        }
        
        if($request->hasFile('thumbnail')){
            $image = $request->file('thumbnail');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(200, 200)->save( public_path('/img/exercise/' . $filename ) );
            $exercise->image = $filename;
            $exercise->save();
        }
        $exercise->save();
        toast('Exercise updated!','success','top-right')->showCloseButton();
        return redirect('/exercise_list');
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
