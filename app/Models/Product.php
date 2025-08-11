<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'sku',
        'sku_ref',
        'variant',
        'price_selling',
        'price_cost',
        'quantity',
        'store_id',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
