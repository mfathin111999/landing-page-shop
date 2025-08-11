<?php 

namespace App\Data;

use App\Models\Product;
use App\Traits\RepositoryTrait;

class ProductRepository
{
    protected $model;
    use RepositoryTrait;

    public function __construct(Product $model)
    {
        $this->model = $model;
    }
}