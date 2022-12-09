<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['id_group', 'name'];

    public function price() {
        return $this->hasOne(Price::class, 'id_product');
    }

    public function group() {
        return $this->belongsTo(Group::class, 'id_group');
    }

    public function scopeGetAllByPagination($query, $quantity, $arrIds = null, $sort = 'nameAsc') {
        switch($sort) {
            case 'nameAsc':
                $sort = 'asc';
                $group = 'name';
                break;
            case 'nameDesc':
                $sort = 'desc';
                $group = 'name';
                break;
            case 'priceAsc':
                $sort = 'asc';
                $group = 'price';
                break;
            case 'priceDesc':
                $sort = 'desc';
                $group = 'price';
                break;

        }
        if (!$arrIds) {
            return $query->select('products.*', 'prices.price')
                ->leftJoin('prices', 'products.id', 'prices.id_product')
                ->orderBy($group, $sort)
                ->paginate($quantity);
        }
        else {
            return $query->select('products.*', 'prices.price')
                ->leftJoin('prices', 'products.id', 'prices.id_product')
                ->whereIn('products.id_group', $arrIds)
                ->orderBy($group, $sort)
                ->paginate($quantity);
        }
    }

    public function scopeGetByGroup($query, $id) {
        return $query->where('id_group', $id)->count();
    }

    public function scopeGetById($query, $id) {
        return $query->with('price')->where('id', $id)->first();
    }
}
