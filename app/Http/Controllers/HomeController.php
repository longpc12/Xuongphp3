<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
       
        $listProduct = Product::query()->get();
        return view('clients.home', compact('listProduct'));
    }

    // public function index()
    // {
    //     $categories = Category::orderByDesc('status')->get();
    //     return view('clients.block.header', compact('categories'));
    // }
    // public function loadAllCate()
    // {
    //     $categories = Category::orderByDesc('status')->get();
  
    //     return view('clients.home', compact('categories'));
    // }

    
}
