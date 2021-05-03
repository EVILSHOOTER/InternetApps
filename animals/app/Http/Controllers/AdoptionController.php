<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\AdoptionRequest;
use App\Models\Animal;

use Gate;

class AdoptionController extends Controller
{
	public function display()
	{
		$adoptionsQuery = AdoptionRequest::all();
		if (Gate::denies('displayall')) { // handy function actually
			$adoptionsQuery=$adoptionsQuery->where('requester', auth()->user()->id);
		}
		return view('/display', array('requesters'=>$adoptionsQuery)); // change view for user
	}
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$adoptionrequests = AdoptionRequest::all()->toArray(); // convert Animal object data to array
		return view('adoptions.index', compact('adoptionrequests')); // send to  view constructor, and return it.
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		return view('adoptions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // create an AdoptionRequest
		$adoptionrequest = new AdoptionRequest;
		$adoptionrequest->animal = $request->input('animal'); // needs value
		$adoptionrequest->requester = auth()->user()->id;
		$adoptionrequest->status = 'Undecided'; // type required?
		$adoptionrequest->created_at = now();
		
		// save it
		$adoptionrequest->save();
		// generate a redirect HTTP response with a success message 
		return back()->with('success', 'AdoptionRequest has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // no need to expand upon an adoption
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $adoptionrequest = AdoptionRequest::find($id);
		return view('adoptions.edit',compact('adoptionrequest'));
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
        $adoptionrequest = AdoptionRequest::find($id);
		$adoptionrequest->status = $request->input('status');
		$adoptionrequest->updated_at = now();
		$adoptionrequest->save();
		
		// find animal's ID and change availability
		$animal = Animal::find($adoptionrequest->animal);
		if ($request->input('status') == 'Approved') {
			$animal->availability = 'Adopted';
		} else {
			$animal->availability = 'Available';
		}
		$animal->save();
		
		return redirect('adoptions');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // left out for user.
    }
	
	
}
