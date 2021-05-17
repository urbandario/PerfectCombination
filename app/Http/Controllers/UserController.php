<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use Image;

class UserController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('profile')->with('user',$user);
    }

    public function updateAvatar(Request $request)
    {
        if($request->hasFile('avatar')){
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300, 300)->save( public_path('/img/avatars/' . $filename ) );
            $user = auth()->user();
            $user->avatar = $filename;
            $user->save();
        }
        toast('Image changed!','success','top-right')->showCloseButton();
        return redirect()->back();
    }

    public function updateBiography(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "biography" => "required|string",
        ]);
        $validator->validate();
        $user = auth()->user();
        $user->biography = $request->biography;
        $user->save();

        toast('Biography changed!','success','top-right')->showCloseButton();
        return redirect()->back();
    }
}
