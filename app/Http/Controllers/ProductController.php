<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    function getProducts(){
        $products=Product::all();
        return response()->json([
            'status' => 'success',
            'products' => $products,
        ]);
    }

    
}
