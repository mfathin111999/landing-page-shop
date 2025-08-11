<?php 

namespace App\Data;

use App\Models\Income;
use App\Traits\RepositoryTrait;

class IncomeRepository
{
    protected $model;
    use RepositoryTrait;

    public function __construct(Income $model)
    {
        $this->model = $model;
    }

    public function getLastBatch()
    {
        return $this->model->max('batch') ?? 1;
    }
}