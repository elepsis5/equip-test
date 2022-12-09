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
        $this->bread = array_values(
            array_unique(
                array_reduce(
                    $this->breadCollect($this->groupsTree), 'array_merge', array()
                )
            )
        );

        $this->menu = $this->groupsTree;
        if ($this->bread) {
            $this->buildBreadMenu($this->bread, $this->groups, $this->breadMenu);
        }
    }

    public function buildTree($array):array {
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

    public function getChild($child, &$array, &$sum):void {
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

    public function breadInit($treeArray, &$tempIds, &$storeIds, &$tempNode):void {
        if (array_key_exists('id',$treeArray)) {
            if (array_key_exists('id_parent', $treeArray) && $treeArray['id_parent'] == 0) {
                $tempIds = [];
                $tempIds[] = $treeArray['id'];
            }

            if(array_key_exists('current', $treeArray)  && $treeArray['current'] == true) {
                $tempIds[] = $treeArray['id'];
                $storeIds[] = $tempIds;
                $storeIds[] = $tempNode;
                return;
            }
            elseif (array_key_exists('child', $treeArray)) {
                $tempNode[$treeArray['id']] = $treeArray['id'];

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

    public function breadCollect($treeArray):array {
        $storeIds = [];
        $tempIds = [];
        $tempNode = [];

        $this->breadInit($treeArray, $tempIds,$storeIds,$tempNode);

        return $storeIds;
    }

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
