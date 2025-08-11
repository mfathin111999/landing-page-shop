<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = [
        'name',
        'user_id',
    ];

    /**
     * Get the users associated with the group.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
