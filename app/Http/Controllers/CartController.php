<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartCreateRequest;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class CartController extends Controller
{
    

    public function show(): View
    {
        return view('carts', [
            'carts' => Cart::all()
        ]);
    }

    public function create(){

        return view('cart.create',[
            'products' => Product::where('cart_id', null)->get()
        ]);

    }

    public function store(CartCreateRequest $request): RedirectResponse
    {
       
        /*
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'products' => 'present|array'
        ]);
         
        if ($validator->fails()) {

            return redirect()->route('cart.create')->withErrors($validator);
        }
        */

        $newCart = new Cart;

        $newCart->name = $request->name;

        $newCart->save();

        foreach($request->products as $product => $value){

          $product = Product::findOrFail($value);

          $product->cart_id = $newCart->id;

          $product->save();

        }

        return redirect()->route('carts');
        /*
       Cart::create([
            'name' => $request->name
       ]);
        */

    }

    public function delete($id){
        
        $cart=Cart::findOrFail($id);


        $products = $cart->products;

        foreach($products as $product){

            $product->cart_id = null;
            $product->save();
        }


        $cart->delete();


        return redirect()->route('carts');

    }

    public function detail($id){

        $cart = Cart::findOrFail($id);

        return view('cart.detail',[
            'products' => $cart->products,
            'cart' => $cart
        ]);

    }

    public function edit($id){

        $cart = Cart::findOrFail($id);

        return view('cart.edit',[
                    'products' => $cart->products,
                    'cart' => $cart
                ]);

            }

    public function removeProducts(Request $request){

        $productsList = $request->products;

        foreach($productsList as $id){

            $product = Product::FindOrFail($id);

            $product->cart_id = null;

            $product->save();

        }

    }

}
