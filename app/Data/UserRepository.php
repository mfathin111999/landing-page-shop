<?php

namespace App\Data;

use App\Models\User;
use App\Traits\RepositoryTrait;

class UserRepository
{
    protected $model;
    use RepositoryTrait;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function query($request)
    {
        return $this->model;
    }
}
