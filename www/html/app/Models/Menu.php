<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Models\Group;

class Menu extends Model
{
    public Collection $basicGroups;
    public array $groupsTree;
    public array $menu;
    public  $groups;
    public int $requestId;
    public array $bread = [];
    public array $breadMenu = [];

    public function __construct($id = 0) {
        parent::__construct();
        $this->requestId = $id;
        $this->groups = Group::getWithCount();
        $this->groupsTree = $this->buildTree($this->groups);
//        $this->bread = array_values(
//            array_unique(
//                array_reduce(
//                    $this->breadCollect($this->groupsTree), 'array_merge', array()
//                )
//            )
//        );
        $this->bread = $this->breadCollect($this->groupsTree);

        $this->menu = $this->groupsTree;
        if ($this->bread) {
            $this->buildBreadMenu($this->bread, $this->groups, $this->breadMenu);
        }
    }

    /**
     * строим вложенное меню
     *
     * @param array $array массив с группами
     *
     * @return array
     */
    public function buildTree(array $array):array {
        $tree = [];
        foreach ($array as $id => $child) {
            if ($this->requestId == $child['id']) {
                $child['current'] = true;
            }
            if (!$child['id_parent']) {
                $tree[$id] = $child;
            }
            else{
                $this->getChild($child, $tree, $sum);
            }
        }
        return $tree;
    }

    /**
     * получаем дочерний элемент каждой подгруппы
     *
     * @param array $child
     * @param array $array массив с группами
     *
     * @param $sum
     * @return void
     */
    public function getChild(array $child, array &$array, &$sum):void {
        foreach ($array as &$item) {
            $sum += $item['count'];
            if ($child['id_parent'] == $item['id']) {
                $item['child'][$child['id']] = $child;
            }
            elseif (array_key_exists('child',$item)) {
                $this->getChild($child, $item['child'], $sum);
            }
        }
    }

    /**
     * собираем хлебные крошки
     *
     * @param array $treeArray дерево групп
     * @param array $tempIds
     * @param array $storeIds храним тут
     * @param array $tempNode
     *
     * @return void
     */
    public function breadInit(array $treeArray, array &$tempIds, array &$storeIds, array &$tempNode):void {
        if (array_key_exists('id',$treeArray)) {
            if (array_key_exists('id_parent', $treeArray) && $treeArray['id_parent'] == 0) {
                $tempIds[] = $treeArray['id'];
            }

            if(array_key_exists('current', $treeArray)  && $treeArray['current'] == true) {
                $tempNode[] = $treeArray['id'];
                $storeIds = array_merge($tempIds, $tempNode);
                return;
            }
            elseif (array_key_exists('child', $treeArray)) {
                $tempNode[] = $treeArray['id'];
                $this->breadInit($treeArray['child'], $tempIds, $storeIds, $tempNode);
            }
        }
        else {
            foreach ($treeArray as $item) {
                $this->breadInit($item, $tempIds, $storeIds, $tempNode);
            }
            $tempNode = [];
        }
    }

    /**
     * сохраняем хлебные крошки
     *
     * @param array $treeArray дерево групп
     *
     * @return array
     */
    public function breadCollect(array $treeArray):array {
        $storeIds = [];
        $tempIds = [];
        $tempNode = [];

        $this->breadInit($treeArray, $tempIds,$storeIds,$tempNode);

        return $storeIds;
    }

    /**
     * создаем меню из хлебных крошек
     *
     * @param array $bread ids крошек
     * @param array $arrOfGroups массив групп
     * @param array $breadMenu храним тут
     *
     * @return array
     */
    public function buildBreadMenu($bread, $arrOfGroups, &$breadMenu) {
        $i = 0;
        $count = count($bread);
        while ($i < $count) {
            foreach ($arrOfGroups as $group) {
                if ($group['id'] == $bread[$i]) {
                    $breadMenu[] = $group;
                }
            }
            $i++;
        }
    }
}
