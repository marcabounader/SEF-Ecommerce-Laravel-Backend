<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth:users');
    // }

    function getCarts(){
        $user=auth('users')->user();

        try{
            $products=DB::table('users')
            ->where('users.id',$user->getAuthIdentifier())
            ->join('carts', 'users.id', '=', 'carts.user_id')
            ->join('products', 'carts.product_id', '=', 'products.id')
            ->select('products.id', 'products.product_name', 'products.product_description','products.product_category','products.product_image','carts.quantity')
            ->get();

            return response()->json([
                'status' => 'success',
                'products' => $products,
            ]);
            
        } catch(e){
            return response()->json([
                'status' => 'error',
            ]);

        }


        // $products = User::find($user->getAuthIdentifier())->cart_products()->get();

    }
    public function addCart(Request $request)
    {        
        $cart = new Cart;

        // Validate the request...
        $user=auth('users')->user();

 
        $cart->user_id = $user->getAuthIdentifier();
        $cart->product_id = $request->product_id;
        $cart->quantity="1";
        $cart->save();
 
        return response()->json([
            'status' => 'success',
        ]);
    }   

    public function updateQuantity(Request $request){
        $user=auth('users')->user();
        
        $product_id=$request->product_id;
        $quantity=$request->quantity;
        try{
            Cart::where([['user_id','=',$user->getAuthIdentifier()],['product_id','=',$product_id]])->update(['quantity'=>$quantity]);
            return response()->json([
                'status' => 'success'
            ]); 
        } catch(e){
            return response()->json([
                'status' => 'error'
            ]); 
        }

    }

    public function deleteCart(Request $request,string $product_id)
    {
        $user=auth('users')->user();
        Cart::where([['user_id', '=', $user->getAuthIdentifier()],['product_id', '=', $product_id]])->delete();
        return response()->json([
            'status' => 'success'
        ]); 
    }   

}
