<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Favorite;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ManageProductController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth:admins');
    // }
    function getProducts(){
        $products=Product::all();
        return response()->json([
            'status' => 'success',
            'products' => $products,
        ]);
    }
    public function addProduct(Request $request)
    {
        // Validate the request...
 
        $product = new Product;
 
        $product->product_name = $request->product_name;
        $product->product_description = $request->product_description;
        $product->product_category = $request->product_category;
        $product->product_image = $request->product_image;

        $product->save();
 
        return response()->json([
            'status' => 'success',
        ]);
    }   

    public function updateProduct(Request $request)
    {
        // Validate the request...
 
 
        $id=$request->id;
        $product_name=$request->product_name;
        $product_description=$request->product_description;
        $product_category=$request->product_category;
        $product_image=$request->product_image;
        Product::where('id',$id)->update(['product_name'=>$product_name,'product_description'=>$product_description,'product_category'=>$product_category,'product_image'=>$product_image]);
        return response()->json([
            'status' => 'success',
        ]); 

    }   

    public function deleteProduct(Request $request)
    {
        // Validate the request...
        $id=$request->id;
        Favorite::where('product_id', '=', $id)->delete();
        Cart::where('product_id', '=', $id)->delete();
        Product::where('id',$id)->delete();
        return response()->json([
            'status' => 'success'
        ]); 
    }   
}
