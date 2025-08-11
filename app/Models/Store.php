<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $fillable = [
        'name',
        'group_id',
    ];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
    
    public function incomes()
    {
        return $this->hasMany(Income::class);
    }
}
