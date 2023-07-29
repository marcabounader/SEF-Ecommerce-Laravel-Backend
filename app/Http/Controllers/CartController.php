<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth:users');
    // }

    function getCarts(){
        $user=auth('users')->user();

        $products = User::find($user->getAuthIdentifier())->cart_products()->get();
        return response()->json([
            'status' => 'success',
            'products' => $products,
        ]);
        
    }
    public function addCart(Request $request)
    {        
        $cart = new Cart;

        // Validate the request...
        $user=auth('users')->user();

 
        $cart->user_id = $user->getAuthIdentifier();
        $cart->product_id = $request->product_id;

        $cart->save();
 
        return response()->json([
            'status' => 'success',
        ]);
    }   



    public function deleteCart(Request $request,string $product_id)
    {
        $user=auth('users')->user();
        Cart::where([['user_id', '=', $user->getAuthIdentifier()],['id', '=', $product_id]])->delete();
        return response()->json([
            'status' => 'success'
        ]); 
    }   

}
