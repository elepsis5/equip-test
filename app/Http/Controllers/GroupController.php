<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Models\Menu;

use function Doctrine\Common\Cache\Psr6\get;

class GroupController extends Controller
{
    public function toGroup(Request $request, $id) {
        $ids = [];

        $menu = new Menu();
        $menu = $menu->menu;
        $group = $this->getGroupByRequest($menu, $id);
        $this->getGroupIds($group, $ids);
        $productsQuantity = Product::whereIn('id_group', $ids)->get()->count();
        $products = Product::getByIds($ids,6);

        return view('app/index', [
            'products' => $products,
            'menu' => $menu,
            'productsQuantity' => $productsQuantity
        ]);
    }

    public function getGroupIds($array, &$arrOfChildren):void {
        if (array_key_exists('id',$array)) {
            $arrOfChildren[] = $array['id'];
            if (array_key_exists('child', $array)) {
                $this->getGroupIds($array['child'], $arrOfChildren);
            }
        }
        else {
            foreach ($array as $item) {
                $arrOfChildren[] = $item['id'];
                if (array_key_exists('child', $item)) {
                    $this->getGroupIds($item['child'], $arrOfChildren);
                }
            }
        }
    }

    public function getGroupByRequest($array, $request) {
        $result = [];
        foreach($array as $item) {
            if ($item['id'] == $request) {
                $result = $item;
            }
        }
        return $result;
    }
}
