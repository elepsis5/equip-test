<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Group;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use App\Models\Menu;

use function PHPUnit\Framework\isEmpty;

class IndexController extends Controller
{
    public int $countOfProducts;

    public function index() {
        $products = Product::getAllByPagination(6);

        $menu = new Menu();
        $menu = $menu->menu;

        return view('app/index', [
            'products' => $products,
            'menu' => $menu
        ]);
    }
}
