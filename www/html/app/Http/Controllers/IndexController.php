<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

use App\Models\Menu;

use function PHPUnit\Framework\isEmpty;

class IndexController extends Controller
{
    public int $countOfProducts;

    public function index() {
        $products = Product::getAllByPagination(6);

        $menu = new Menu();
        $menuTree = $menu->menu;
        $bread = $menu->bread;

        return view('app/index', [
            'products' => $products,
            'menu' => $menuTree,
            'bread' => $bread
        ]);
    }
}
