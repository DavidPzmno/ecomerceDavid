<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    

    public function index(): View
    {
        
        return view('index', [
            'products' => Product::where('cart_id', null)->get(),
            'carts' => Cart::all()
        ]);

    }

}
