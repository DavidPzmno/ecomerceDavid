<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    
    public function index(){

        $products = Product::all();

        $countProducts = collect($products);



        return response()->json([
            "status" => true,
            "count" => $countProducts->count(),
            "message" => $countProducts->count() > 0 ? "return all carts" : "there are not carts",
            "data" => $products
        ], 200);

    }

}