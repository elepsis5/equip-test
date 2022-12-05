<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function getAll() {
        $products = Product::getByPagination(6);
        return view('app/index', compact('products'));
    }
}
