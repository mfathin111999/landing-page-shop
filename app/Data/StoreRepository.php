<?php

namespace App\Data;

use App\Models\Store;
use App\Traits\RepositoryTrait;

class StoreRepository
{
    protected $model;
    use RepositoryTrait;

    public function __construct(Store $model)
    {
        $this->model = $model;
    }

    public function query($request)
    {
        return $this->model->select('stores.id', 'stores.name', 'stores.group_id', 'groups.name as group_name')
            ->join('groups', 'groups.id', '=', 'stores.group_id')
            ->when(!$request->user()->hasRole('superadmin'), function ($query) use ($request) {
                $query->where('groups.user_id', $request->user()->id);
            });
    }

    public function getStoreByUser($userId, $request)
    {
        return $this->model
            ->when(!$request->user()->hasRole('superadmin'), function ($query) use ($userId) {
                $query->whereHas('group', function ($query) use ($userId) {
                    $query->where('groups.user_id', $userId);
                });
            }, function ($query) use ($userId, $request) {
                $query->where('groups.user_id', $request->id ?? $userId);
            })->pluck('name', 'id');
    }
}
