<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Models\Group;

class Menu extends Model
{
    public Collection $basicGroups;
    public array $groupsTree;
    public array $menu;
    public array $groups;

    public function __construct() {
        parent::__construct();
        $this->groups = Group::all()->toArray();
        $this->groupsTree = $this->getGroupsTree($this->groups);
        $this->menu = $this->groupsTree;
    }

    public function getGroupsTree(array $groups):array {
        foreach ($groups as $basicGroup) {
            return $this->buildTree($groups);
        }
    }

    public function buildTree($array):array {
        $tree = [];
        foreach ($array as $id => $child) {
            if (!$child['id_parent']) {
                $tree[$id] = $child;
            }
            else{
                $this->getChild($child, $tree);
            }
        }
        return $tree;
    }

    public function getChild($child, &$array) {
        foreach ($array as &$item) {
            if ($child['id_parent'] == $item['id']) {
                $item['child'][$child['id']] = $child;
            }
            elseif (array_key_exists('child',$item)) {
                $this->getChild($child, $item['child']);
            }
        }
    }
}
