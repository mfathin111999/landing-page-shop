<?php 

namespace App\Data;

use App\Models\Order;
use App\Traits\RepositoryTrait;

class OrderRepository
{
    protected $model;
    use RepositoryTrait;

    public function __construct(Order $model)
    {
        $this->model = $model;
    }

    public function getLastBatch()
    {
        return $this->model->max('batch') ?? 1;
    }
}