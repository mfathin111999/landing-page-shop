<?php

namespace App\Data;

use App\Models\Group;
use App\Traits\RepositoryTrait;

class GroupRepository
{
    protected $model;
    use RepositoryTrait;

    public function __construct(Group $model)
    {
        $this->model = $model;
    }

    public function query($request)
    {
        return $this->model->select('groups.*', 'users.name as owner_name')
            ->leftJoin('users', 'users.id', '=', 'groups.user_id')
            ->when(!$request->user()->hasRole('superadmin'), function ($query) use ($request) {
                $query->where('groups.user_id', $request->user()->id);
            });
    }

    public function listByUserId ($request) {
        return $this->model->select('groups.*')
            ->leftJoin('users', 'users.id', '=', 'groups.user_id')
            ->where('users.id', $request->user()->id)
            ->pluck('name', 'id');
    }
}
