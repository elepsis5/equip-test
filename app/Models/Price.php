<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['id_product', 'price'];

    public function product() {
        return $this->belongsTo(Product::class);
    }
}
