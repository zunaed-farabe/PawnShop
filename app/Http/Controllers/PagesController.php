<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function ItemsList()
    {
        return view('layouts.items');
    }
}
