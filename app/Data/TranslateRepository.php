<?php

namespace App\Data;

use App\Models\Translate;
use App\Traits\RepositoryTrait;

class TranslateRepository
{
    protected $model;

    use RepositoryTrait;

    public function __construct(Translate $model)
    {
        $this->model = $model;
    }

    public function query($request)
    {
        return $this->model;
    }
}
