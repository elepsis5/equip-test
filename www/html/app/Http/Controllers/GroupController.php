<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Menu;
use Illuminate\Http\Request;

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

    /**
     * получаем все id товаров текущей группы
     *
     * @param array $array дерево текущей группы
     * @param array $storeIds храним тут
     *
     * @return void
     */
    public function getAllGroupIds(array $array, array &$storeIds):void {
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

    /**
     * получаем текущую группу
     *
     * @param array $tree дерево всех групп
     * @param array $group храним тут
     * @param int $request запрос
     *
     * @return void
     */
    public function getGroupByRequest(array $tree, int $request, &$group) {
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
