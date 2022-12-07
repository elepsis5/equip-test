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

    public function scopeGetAllByPagination($query, $quantity) {
        return $query->with('group', 'price')->orderBy('name','desc')->paginate($quantity);
    }

    public function scopeGetByIds($query, $arrIds, $quantity) {
        return $query->whereIn('id_group', $arrIds)->paginate($quantity);
    }
}
