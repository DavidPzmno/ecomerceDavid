<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CartCreateRequest;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{



    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

  */





    public function index()
    {

        $carts = Cart::all();
        $countCarts = collect($carts);



        return response()->json([
            "status" => true,
            "count" => $countCarts->count(),
            "message" => $countCarts->count() > 0 ? "return all carts" : "there are not carts",
            "data" => $carts
        ], 200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function createCar(Request $request)
    {

        $newCart = new Cart;

        $newCart->name = $request->name;

        $newCart->save();

          $product = Product::findOrFail($request->product_id);

          $product->cart_id = $newCart->id;

          $product->save();

        return response()->json([
            "status" => true,
            "message" => "cart created successful",
            "data" => $newCart
        ], 200);
    }


    public function show(Request $request)
    {
        $cart = Cart::findOrFail($request->cartId);
        
        return response()->json([
            "status" => true,
            "message" => "cart",
            "data" => $cart
        ], 200);
    }

}
