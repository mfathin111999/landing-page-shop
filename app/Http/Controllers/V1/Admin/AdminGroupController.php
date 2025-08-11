<?php

namespace App\Http\Controllers\V1\Admin;

use App\Http\Controllers\Controller;

use App\Data\GroupRepository;
use App\Http\Requests\StoreGroupRequest;
use App\Http\Requests\UpdateGroupRequest;
use Illuminate\Http\Request;

class AdminGroupController extends Controller
{
    protected $repository;

    public function __construct(GroupRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $request->wantsJson() || $request->ajax()
            ? $this->repository->call($request)
            : view('master.group');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGroupRequest $request)
    {
        $data = $this->repository->store($request);

        return $request->wantsJson() || $request->ajax()
            ? $this->apiResponseSuccess($data)
            : redirect()->route('groups.index')->with('success', 'Group created successfully');
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGroupRequest $request, $group_id)
    {
        $data = $this->repository->update($request, $group_id);

        return $request->wantsJson() || $request->ajax()
            ? $this->apiResponseSuccess($data)
            : redirect()->route('groups.index')->with('success', 'Group updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $group_id)
    {
        $this->repository->delete($group_id);

        return $request->wantsJson() || $request->ajax()
            ? $this->apiResponseSuccess('Group deleted successfully')
            : redirect()->route('groups.index')->with('success', 'Group deleted successfully');
    }
}
