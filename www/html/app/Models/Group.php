<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Group extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['id_parent', 'name'];

    public function products() {
        return $this->hasMany(Product::class,'id_group');
    }

    public function scopeGetBasicGroups($query) {
        return $query->where('id_parent', '0')->get();
    }

    public function scopeGetWithCount($query) {
        return $query->select(array('groups.*', DB::raw('COUNT(products.id) as count')))
            ->leftJoin('products', 'groups.id', 'products.id_group')
            ->groupBy('id')
            ->get()
            ->toArray();
    }
}
