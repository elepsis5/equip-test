<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show($groupId, $productId) {
        $menu = new Menu($groupId);
        $breadMenu = $menu->breadMenu;
        $bread = $menu->bread;

        $product = Product::getById($productId);
        return view('app/product', compact('product', 'breadMenu'));
    }
}
