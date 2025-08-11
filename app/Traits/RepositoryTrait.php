<?php

namespace App\Traits;

use Yajra\DataTables\DataTables;

trait RepositoryTrait
{
    protected $attribute = [];

    public function call($request)
    {
        return DataTables::of($this->query($request))->addIndexColumn()->toJson();
    }

    public function customCall($request)
    {
        return DataTables::of($this->query($request))->addIndexColumn();
    }
    
    public function datatable($query)
    {
        return DataTables::of($query)->addIndexColumn();
    }

    public function query($request)
    {
        $serverSide = $this->serverSide ?? false;
        return $serverSide == false 
            ? $this->model->get()
            : $this->model;
    }

    public function store($request)
    {
        return is_array($request)
            ? $this->model->create($request)
            : $this->model->create($request->only($this->column ?? $this->attribute));
    }

    public function getById($id)
    {
        return $this->model->findOrFail($id);
    }

    public function update($id, $request)
    {
        return is_array($request)
            ? $this->getById($id)->update($request)
            : $this->getById($id)->update($request->only($this->column ?? $this->attribute));
    }

    public function listStatus()
    {
        return $this->list ?? true;
    }

    public function list($columnData = 'name')
    {
        return $this->listStatus()
            ? $this->model->select('id', $columnData)->pluck($columnData, 'id')
            : [];
    }

    public function delete($id)
    {
        return $this->getById($id)->delete();
    }

    public function deletes($ids)
    {
        return $this->model->whereIn('id', $ids)->delete();
    }
}
