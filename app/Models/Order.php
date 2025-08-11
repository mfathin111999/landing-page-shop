<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'code',
        'sku',
        'sku_ref',
        'variant',
        'quantity',
        'city',
        'province',
        'total',
        'date_ordered',
        'date_finished',
        'store_id',
        'batch',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
