<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Listing;

class ListingsController extends Controller
{
    //Add Constructor - so that we can user authenticate certain methods.
    public function __construct(){
        // $this->middleware('auth'); //Make the entire class/functions password protected.
        $this->middleware('auth', ['except' => ['index', 'show']]); //Make the entire class/functions except methods noted here.
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Grab all listings - with a descending sort by create timestamp.
        $listings = Listing::orderBy('created_at', 'desc')->get();

        //Return view with listings data.
        return view('listings')->with('listings', $listings);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('createlisting');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validate input
        $this->validate($request, [
            'name' => 'required',
            'email' => 'email'
        ]);

        //Create Listing
        $listing = new Listing;
        $listing->name = $request->input('name');
        $listing->website = $request->input('website');
        $listing->email = $request->input('email');
        $listing->phone = $request->input('phone');
        $listing->address = $request->input('address');
        $listing->bio = $request->input('bio');
        $listing->user_id = auth()->user()->id; //Current logged in user's id.

        //Save Listing
        $listing->save();

        //Redirect to dashboard
        return redirect('/dashboard')->with('success', 'Added Listing');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Grab all listings - with a descending sort by create timestamp.
        $listing = Listing::find($id);

        //Return view with listing data.
        return view('showlisting')->with('listing', $listing);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Find listing by ID
        $listing = Listing::find($id);

        //Return view with listing data
        return view('editlisting')->with('listing', $listing);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Validate input
        $this->validate($request, [
            'name' => 'required',
            'email' => 'email'
        ]);

        //Find listing by ID
        $listing = Listing::find($id);

        //Edit Listing
        $listing->name = $request->input('name');
        $listing->website = $request->input('website');
        $listing->email = $request->input('email');
        $listing->phone = $request->input('phone');
        $listing->address = $request->input('address');
        $listing->bio = $request->input('bio');
        $listing->user_id = auth()->user()->id; //Current logged in user's id.

        //Save Listing
        $listing->save();

        //Redirect to dashboard
        return redirect('/dashboard')->with('success', 'Listing Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Find listing by ID
        $listing = Listing::find($id);

        //Delete listing
        $listing->delete();

        //Redirect to dashboard
        return redirect('/dashboard')->with('success', 'Listing Removed');
    }
}
