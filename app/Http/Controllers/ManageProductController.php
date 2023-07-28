<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ManageProductController extends Controller
{

    public function setProduct(Request $request): RedirectResponse
    {
        // Validate the request...
 
        $product = new Product;
 
        $product->product_name = $request->name;
        $product->product_description = $request->description;
        $product->product_image = $request->image;

        $product->save();
 
        return response()->json([
            'status' => 'success',
        ]);
    }   

    public function updateProduct(Request $request): RedirectResponse
    {
        // Validate the request...
 
        $product = new Product;
 
        $product->product_name = $request->name;
        $product->product_description = $request->description;
        $product->product_image = $request->image;

        $product->save();
 
        return response()->json([
            'status' => 'success',
        ]);
    }   

    public function deleteProduct(Request $request): RedirectResponse
    {
        // Validate the request...
 
        $product = new Product;
 
        $product->product_name = $request->name;
        $product->product_description = $request->description;
        $product->product_image = $request->image;

        $product->save();
 
        return response()->json([
            'status' => 'success',
        ]);
    }   
}
