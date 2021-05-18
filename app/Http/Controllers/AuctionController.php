<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Aouction;
use App\Item;
use DB;

class AuctionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $auctionitems = DB::table('items')
        ->join('aouctions', 'items.id', '=', 'aouctions.item')
        ->select('items.*')
        ->get();

        return view('layouts.showauctiontable')->with('auctionitems', $auctionitems); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        

        $Aouction = new Aouction;
      
        $Aouction->price = $request->input('name');
        $Aouction->from = auth()->user()->id;
        $Aouction->to = auth()->user()->id;
        $Aouction->item =  $request->input('item');
      //  $Aouction->item =  session()->get('itemId');

       
        $Aouction->save();
        
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
        $Aouction = Aouction::where('item', '=',$id)->first();
        
      
        $Aouction->price = $request->input('price');
        
        //$Aouction->To = auth()->user()->id;
        $Aouction->To =  $request->input('to');

       
        $Aouction->save();
        
        return redirect('/items')->with('success', 'Item Added');
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
    }
    public function bid($id)
    {
        $item = Item::find($id);
        
        session()->put('itemId',$id);

        

        return view('layouts.placebid')->with('item', $item); 
    }

    public function end()
    {
        $Aouction = Aouction::all();
        foreach($Aouction as $ac)
       {
    //     $acto= $ac->To;
       //  $acitem = Item::find($ac->item);

//         $acitem->user_id= $acto;
    //     $acitem->save();
         $ac->delete();
       }
       
       return redirect()->back();
    }
}
