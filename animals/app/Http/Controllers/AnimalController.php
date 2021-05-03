<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Animal;

class AnimalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	
	// used by staff to add, edit, delete animals and to accept/deny requests.
	
	// e.g. animals.create = in resource/views. animals is the folder holding them views, create = create.blade.php
	// :: = sorta like ->, but for accessing instances in a class. -> is for objects
	// -> = for objects, access functions. (e.g. $request => hasFile(...) means request.hasFile(...) )
	// => = array access. (e.g. 'name' => 'required' means "name" = "required" in a dictionary.) used for setting.
	// $this = reference to current object
	// compact(param...) = the parameter takes a string containing the name of the variable.
	
    public function index()
    {
        //
		$animals = Animal::all()->toArray(); // convert Animal object data to array
		return view('animals.index', compact('animals')); // send that to the view constructor, and return it.
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
		return view('animals.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	 
	
    public function store(Request $request)
    {
        //
		// form validation
		$vehicle = $this->validate(request(), [ 
			'name' => 'required',
			'type' => 'required',
			'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:500',
		]);
		//Handles the uploading of the image 
		if ($request->hasFile('image')){
			//Gets the filename with the extension
			$fileNameWithExt = $request->file('image')->getClientOriginalName();
			//just gets the filename
			$filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
			//Just gets the extension
			$extension = $request->file('image')->getClientOriginalExtension();
			//Gets the filename to store
			$fileNameToStore = $filename.'_'.time().'.'.$extension;
			//Uploads the image
			$path = $request->file('image')->storeAs('public/images', $fileNameToStore);
		}
		else {
			$fileNameToStore = 'noimage.jpg';
		}
		// create a Animal object and set its values from the input
		// basically all the database table entries.
		$animal = new Animal;
		$animal->name = $request->input('name');
		$animal->type = $request->input('type');
		$animal->date_of_birth = $request->input('date_of_birth');
		$animal->description = $request->input('description');
		//$animal->availability = True;//$animal->availability = $request->input('availability');
		$animal->created_at = now();
		$animal->image = $fileNameToStore;
		
		// save the Animal object
		$animal->save();
		// generate a redirect HTTP response with a success message 
		return back()->with('success', 'Animal has been added');
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
		$animal = Animal::find($id);
		return view('animals.show',compact('animal'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
		$animal = Animal::find($id);
		return view('animals.edit',compact('animal'));

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
        //
		$animal = Animal::find($id);
		$this->validate(request(), [ 
		'name' => 'required',
		]);
		$animal->name = $request->input('name');
		$animal->type = $request->input('type');
		$animal->date_of_birth = $request->input('date_of_birth');
		$animal->description = $request->input('description');
		//$animal->availability = True;//$animal->availability = $request->input('availability');
		$vehicle->updated_at = now();
		//Handles the uploading of the image 
		if ($request->hasFile('image')){
			//Gets the filename with the extension
			$fileNameWithExt = $request->file('image')->getClientOriginalName();
			//just gets the filename
			$filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
			//Just gets the extension
			$extension = $request->file('image')->getClientOriginalExtension();
			//Gets the filename to store
			$fileNameToStore = $filename.'_'.time().'.'.$extension;
			//Uploads the image
			$path = $request->file('image')->storeAs('public/images', $fileNameToStore);
		} else {
			$fileNameToStore = 'noimage.jpg';
		}
		$animal->image = $fileNameToStore;
		$animal->save();
		return redirect('animals');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
		$animal = Animal::find($id);
		$animal->delete();
		return redirect('animals');
    }
}
