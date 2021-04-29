<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;

use DB;

class ItemsController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
       // $items = DB::select('select * from items');

        $items = Item::orderBy('id', 'desc')->paginate(7);

        return view('layouts.items')->with('items', $items); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('layouts.createitem');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=> 'required',
            'description'=> 'required',
            'image'=> 'image|max:1999'

        ]);

            //handle file upload 
            if($request->hasfile('image')){

                // Get filename with the extension
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('image')->storeAs('public/image', $fileNameToStore);
		
	    // make thumbnails
	        //$thumbStore = 'thumb.'.$filename.'_'.time().'.'.$extension;
           // $thumb = Image::make($request->file('image')->getRealPath());
           // $thumb->resize(80, 80);
           // $thumb->save('storage/image/'.$thumbStore);
            }
            


        $item = new Item;
        $item->name = $request->input('name');
        $item->description = $request->input('description');
        $item->image = $fileNameToStore;
        $item->user_id = auth()->user()->id;
        $item->save();
        
        return redirect('/items')->with('success', 'Item Added');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Item::find($id);
        if(auth()->user()->id !== $item->user_id){
            return 'UnAuthorized';
        }
        
        return view('layouts.showitem')->with('item', $item);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Item::find($id);

        if(auth()->user()->id !== $item->user_id){
            return redirect('/items')->with('error', 'Unauthorized page');
        }

        return view('layouts.edititem')->with('item', $item);
        
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
        $this->validate($request,[
            'name'=> 'required',
            'description'=> 'required',
        ]);
        
        if($request->hasfile('image')){

            // Get filename with the extension
        $filenameWithExt = $request->file('image')->getClientOriginalName();
        // Get just filename
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        // Get just ext
        $extension = $request->file('image')->getClientOriginalExtension();
        // Filename to store
        $fileNameToStore= $filename.'_'.time().'.'.$extension;
        // Upload Image
        $path = $request->file('image')->storeAs('public/image', $fileNameToStore);
        }


        $item = Item::find($id);
        $item->name = $request->input('name');
        $item->description = $request->input('description');
        $item->user_id = auth()->user()->id;
        if($request->hasfile('image')){
            $item->image = $fileNameToStore;
        }
        $item->save();
        
        return redirect('/items')->with('success', 'Item Info Updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Item::find($id);

        if(auth()->user()->id !== $item->user_id){
            return redirect('/items')->with('error', 'Unauthorized page');
        }

        $item->delete();
        
        return redirect('/items')->with('success', 'Item Deleted');

    }

  

    public function addauction($id)
    {
        $item = Item::find($id);
        
        session()->put('itemId',$id);

        if(auth()->user()->id !== $item->user_id){
            return redirect('/items')->with('error', 'Unauthorized page');
        }

        return view('layouts.addauction')->with('item', $item);   
    }
}
