<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Models\Group;

class Menu extends Model
{
    public array $groupsTree;
    public Collection $basicGroups;


    public function __construct() {
        parent::__construct();
        $this->basicGroups = Group::getBasicGroups();
        $this->getGroupsTree($this->basicGroups);

    }

    public function getGroupsTree($groups):void {

        foreach ($groups as $basicGroup) {
            $rootGroup = [];
            $rootGroup['id'] =  $basicGroup->id;
            $rootGroup['name'] =  $basicGroup->name;
            $child = [];
            $this->buildTree($rootGroup, $child);
            $rootGroup['child'] =  $child;
            $this->groupsTree[] = $rootGroup;
        }
    }

    public function buildTree($parent, &$arrOfChildren):void {
        $children = DB::table('groups')->where('id_parent', $parent['id'])->get()->toArray();
        if ($children) {
            foreach ($children as $id => $child) {
                $count = DB::table('products')->where('id_group', $child->id)->count();
                $child = (array)$child;
                if ($count > 0) {
                    $child['count'] = $count;
                }
                $child['child'] = [];
                $arrOfChildren[$child['id']] = $child;
                $this->buildTree($child, $arrOfChildren[$child['id']]['child']);
            }
        }
    }

    public function getCountOfProducts($arrOfGroups):array {
        $countInGroup = [];
        foreach ($arrOfGroups as $baseGroup => $value) {
            foreach ($value as $childGroup) {
                $result =  Product::query()->where('id_group', $childGroup->id)->count();

                if ($result > 0) {
                    $countInGroup[$baseGroup][] = $result;
                }
            }
            $countInGroup[$baseGroup] = array_sum($countInGroup[$baseGroup]);
        }
        return $countInGroup;
    }
}
