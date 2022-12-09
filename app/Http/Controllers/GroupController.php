<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Models\Menu;

class GroupController extends Controller
{
    public function toGroup($id, $sort = 'nameAsc', $q = 6) {
        $ids = [];
        $group = [];
        $menu = new Menu($id);
        $menuTree = $menu->menu;
        $bread = $menu->bread;
        $this->getGroupByRequest($menuTree, $id, $group);
        $this->getAllGroupIds($group, $ids);
        $products = Product::getAllByPagination($q, $ids, $sort);

        return view('app/index', [
            'products' => $products,
            'menu' => $menuTree,
            'bread' => $bread
        ]);
    }

    public function getAllGroupIds($array, &$storeIds):void {
        if (array_key_exists('id',$array)) {
            $storeIds[] = $array['id'];
            if (array_key_exists('child', $array)) {
                $this->getAllGroupIds($array['child'], $storeIds);
            }
        }
        else {
            foreach ($array as $item) {
                $storeIds[] = $item['id'];
                if (array_key_exists('child', $item)) {
                    $this->getAllGroupIds($item['child'], $storeIds);
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
