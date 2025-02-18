<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller {
    public function all() {
        $products = Product::all();
        return response()->json($products);
    }
}
