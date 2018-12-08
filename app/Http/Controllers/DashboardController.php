<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //Map UID to a var.
        $userId = auth()->user()->id;

        //Find user & data based on their UID.
        $user = User::find($userId);

        //Return view, passing the user listings to the view for parsing.
        return view('dashboard')->with('listings', $user->listings);
    }
}
