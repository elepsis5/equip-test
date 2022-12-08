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
        $group = [];
        $menu = new Menu($id);
        $menuTree = $menu->menu;
        $bread = $menu->bread;

        $this->getGroupByRequest($menuTree, $id, $group);

        $this->getGroupIds($group, $ids);
//        $productsQuantity = Product::whereIn('id_group', $ids)->get()->count();
        $products = Product::getByIds($ids,6);

        return view('app/index', [
            'products' => $products,
            'menu' => $menuTree,
            'bread' => $bread
//            'productsQuantity' => $productsQuantity
        ]);
    }

    public function getGroupIds($array, &$storeIds):void {
        if (array_key_exists('id',$array)) {
            $storeIds[] = $array['id'];
            if (array_key_exists('child', $array)) {
                $this->getGroupIds($array['child'], $storeIds);
            }
        }
        else {
            foreach ($array as $item) {
                $storeIds[] = $item['id'];
                if (array_key_exists('child', $item)) {
                    $this->getGroupIds($item['child'], $storeIds);
                }
            }
        }
    }

    public function getGroupByRequest($tree, $request, &$group) {
        foreach($tree as $item) {
            if ($item['id'] == $request) {
                $group = $item;
            }
            elseif (array_key_exists('child', $item)) {
                $this->getGroupByRequest($item['child'], $request, $group);
            }
        }
    }
}
