<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function filterProduct(Request $request)
    {
        $query = Product::query();
        $categories = Category::all();

        if($request->ajax())
        {
            if(empty($request->category))
            {
                $products = $query->get();
            }
            else
            {
                $products = $query->where(['category_id' => $request->category])->get();
            }
            return response()->json(['products' => $products]);
        }
        $products = $query->get();
        return view('product', compact('categories','products'));
    }
}
