<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Listing;

class ListingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
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
