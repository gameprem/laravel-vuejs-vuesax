<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ProductsController extends Controller
{
    public function index(Request $request)
    {

        $products = Products::all();
        return response()->json($products);
    }
}
