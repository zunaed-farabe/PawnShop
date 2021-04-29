<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Aouction;
use App\Item;
use Auth;
class HomeController extends Controller
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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        if(Auth::user()->id==2){
        return view('home');
        }
        else{
            $items = Item::orderBy('id', 'desc')->paginate(7);

        return view('layouts.items')->with('items', $items);
        }
       
    }
}
