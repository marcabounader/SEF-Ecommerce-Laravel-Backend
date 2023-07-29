<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use \App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth:users');
    // }
    function getFavorites(){
        $user=auth('users')->user();

        $products = User::find($user->getAuthIdentifier())->favorite_products()->get();
        return response()->json([
            'status' => 'success',
            'products' => $products,
        ]);
        
    }
    public function addFavorite(Request $request)
    {
        // Validate the request...
 
        $favorite = new Favorite;
        $user=auth('users')->user();

        $favorite-> user_id=$user->getAuthIdentifier();
        $favorite->product_id = $request->product_id;

        $favorite->save();
 
        return response()->json([
            'status' => 'success',
        ]);
    }   



    public function deleteFavorite(Request $request,string $product_id)
    {
        $user=auth('users')->user();
        Favorite::where([['user_id', '=', $user->getAuthIdentifier()],['product_id', '=', $product_id]])->delete();
        return response()->json([
            'status' => 'success'
        ]); 
    }   

}
