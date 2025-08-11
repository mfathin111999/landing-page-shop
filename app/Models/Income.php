<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    protected $fillable = [
        'code',
        'total',
        'date',
        'store_id',
        'batch',
    ];
    
    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
