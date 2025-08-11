<?php

namespace App\Http\Controllers\V1\User;

use App\Http\Controllers\Controller;

use App\Data\GroupRepository;
use App\Data\StoreRepository;
use App\Http\Requests\StoreStoreRequest;
use App\Http\Requests\UpdateStoreRequest;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    protected $repository;

    public function __construct(StoreRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, GroupRepository $groupRepository)
    {
        return $request->wantsJson() || $request->ajax()
            ? $this->repository->call($request)
            : view('admin.store', [
                'groups' => $groupRepository->list(),
            ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStoreRequest $request)
    {
        $data = $this->repository->store($request);

        return $request->wantsJson() || $request->ajax()
            ? $this->apiResponseSuccess($data)
            : redirect()->route('store.index')->with('success', 'Store created successfully');
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStoreRequest $request, $store_id)
    {
        $data = $this->repository->update($request, $store_id);

        return $request->wantsJson() || $request->ajax()
            ? $this->apiResponseSuccess($data)
            : redirect()->route('store.index')->with('success', 'Store updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $store_id)
    {
        $this->repository->delete($store_id);

        return $request->wantsJson() || $request->ajax()
            ? $this->apiResponseSuccess('Store deleted successfully')
            : redirect()->route('store.index')->with('success', 'Store deleted successfully');
    }
}
