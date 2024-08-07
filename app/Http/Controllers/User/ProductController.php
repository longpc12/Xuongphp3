<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Comment;
use App\Models\BillDentail;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class ProductController extends Controller
{

    // public function home(){
    //     $listProduct = Product::query()->get();
    //     return view('clients.home', compact('listProduct'));
    // }

    // public function dentailProduct(string $id){

    //     $dentailProduct = Product::query()->findOrFail($id);
    //     // dd($dentailProduct);
    //     $listProduct = Product::query()->get();

    //     return view('clients.products.dentailProduct', compact('dentailProduct', 'listProduct'));
    // }
    

    public function dentailProduct(string $id)
    {
        $dentailProduct = Product::with('ProductImage')->findOrFail($id);
        $listProduct = Product::all();
        $comments = Comment::where('product_id', $id)->get();
        $user_id = Auth::id();

        $hasPurchased = BillDentail::where('product_id', $id)
                                    ->whereHas('bill', function($query) use ($user_id) {
                                        $query->where('user_id', $user_id);
                                    })
                                    ->exists();

        return view('clients.products.dentailProduct', compact('dentailProduct', 'listProduct', 'comments', 'hasPurchased'));
    }

    public function shop()
    {
        $categories = Category::all();
        $products = Product::paginate(12);

        return view('clients.products.shop', compact('categories', 'products'));
    }

    public function shopByCategory($categoryId)
    {
        $categories = Category::all();
        $products = Product::where('category_id', $categoryId)->paginate(12);

        return view('clients.products.shop', compact('categories', 'products'));
    }


    

}
