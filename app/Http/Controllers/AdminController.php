<?php

namespace App\Http\Controllers;

use App\Mail\TrainerApproved;
use App\Mail\TrainerDisapproved;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

class AdminController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin/home');
    }
    /**
     * Function for showing admin actions page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function showCheckTrainers()
    {
        $users = User::where('email_verified_at', '!=', null)->where('trainer',1)->orderBy('trainer_approved')->orderBy('created_at', 'desc')->paginate(20);
        return view('admin.check_trainers')->with('users', $users);
    }

    /**
     *  Function that counts current unresolved, valid trainer request.
     *
     * @return integer
     */
    public function getCountTrainerRequest()
    {
        return User::where('email_verified_at', '!=', null)->where('trainer', 1)->where('trainer_approved', 0)->count();
    }

    /**
     *  Approve users trainer request and send an email.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function updateApproveTrainer(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "id" => "required|numeric|exists:users",
        ]);
        $validator->validate();
        $user = User::find($request->id);
        if (!$user->trainer_approved) {
                $user->trainer_approved = 1;
                $user->save();
            Mail::to($user->email)->send(new TrainerApproved($user));
        }
        return redirect()->back();
    }
    /**
     * Disapprove users partner/dealer request, send an email,
     * and delete invalid company, user, and address data.
     *
     *
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function updateDisapproveTrainer(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "id" => "required|numeric|exists:users",
        ]);
        $validator->validate();
        $user = User::find($request->id);
        if (!$user->partner_approved) {
            Mail::to($user->email)->send(new TrainerDisapproved($user));
            $user->delete();
        }
        return redirect()->back();;
    }
}
