<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function showWaitAdminApproval()
    {
        return view('auth.wait_admin');
    }
}
