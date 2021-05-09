<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    /**
     * Show the email verification notice.
        *
        * @param  \Illuminate\Http\Request  $request
        * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
        */
        public function show(\Illuminate\Http\Request $request)
        {
            return view('auth.verify');
        }
    
        /**
         * The user has been verified.
            *
            * @param  \Illuminate\Http\Request  $request
            * @return mixed
            */
        protected function verified($user)
        {
            // toast(trans('swal.emailVerified'), 'success');
            if (!$user->trainer) {
                return redirect('/login');
            } else {
                if (!$user->trainer_approved AND $user->trainer) {
                    return redirect('/waiting_admin_approval');
                }
            }
        }
    
        /**
         * Mark the authenticated user's email address as verified.
            *
            * @param  \Illuminate\Http\Request  $request
            * @return \Illuminate\Http\RedirectResponse|Response|\Illuminate\Routing\Redirector
            *
            * @throws \Illuminate\Auth\Access\AuthorizationException
            */
        public function verify(\Illuminate\Http\Request $request)
        {
            if (!$user = User::find($request->route('id'))) {
                throw new AuthorizationException;
            }
    
            if (!hash_equals((string) $request->route('id'), (string) $user->getKey())) {
                throw new AuthorizationException;
            }
    
            if (!hash_equals((string) $request->route('hash'), sha1($user->getEmailForVerification()))) {
                throw new AuthorizationException;
            }
    
            if ($user->hasVerifiedEmail()) {
                if ($user->trainer AND !$user->trainer_approved) {
                    return redirect('/waiting_admin_approval');
                }
                return $request->wantsJson()
                    ? new Response('', 204)
                    : redirect('/home');
            }
    
            if ($user->markEmailAsVerified()) {
                event(new Verified($request->user()));
            }
    
            if ($response = $this->verified($user)) {
                return $response;
            }
    
            return $request->wantsJson()
                ? new Response('', 204)
                : redirect($this->redirectPath())->with('verified', false);
        }
    
        public function resend(Request $request)
        {
            if (!session()->has('trid')){
                throw new AuthorizationException;
            }
    
            if (session('trid')) {
                $user = User::findOrFail(session('trid'));
                session()->forget('trid');
            }
            else{
                throw new AuthorizationException;
            }
    
            if ($user->hasVerifiedEmail()) {
                return redirect($this->redirectPath());
            }
    
            $user->sendEmailVerificationNotification();
    
            // toast(trans('email.emailResent'), 'success');
            return back();
        }
}
