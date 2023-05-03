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
    

    public function index()
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

    public function store(CartCreateRequest $request)
    {
       

        $newCart = new Cart;

        $newCart->name = $request->name;

        $newCart->save();

        foreach($request->products as $product => $value){

          $product = Product::findOrFail($value);

          $product->cart_id = $newCart->id;

          $product->save();

        }

        return redirect()->route('carts');

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

    public function show($id){

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

    public function addProduct(Request $request) {


        $product = Product::findOrFail($request->productId);

        $product->cart_id = $request->cartId;

        $product->save();

    }

}
