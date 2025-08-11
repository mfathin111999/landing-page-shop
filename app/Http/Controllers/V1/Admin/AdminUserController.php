<?php

namespace App\Http\Controllers\V1\Admin;

use App\Http\Controllers\Controller;

use App\Data\UserRepository;
use App\Http\Requests\StoreStoreRequest;
use App\Http\Requests\UpdateStoreRequest;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    protected $repository;

    public function __construct(UserRepository $repository)
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
            : view('admin.user');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStoreRequest $request)
    {
        $data = $this->repository->store($request);

        return $request->wantsJson() || $request->ajax()
            ? $this->apiResponseSuccess($data)
            : redirect()->route('user.index')->with('success', 'User created successfully');
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStoreRequest $request, $user_id)
    {
        $data = $this->repository->update($request, $user_id);

        return $request->wantsJson() || $request->ajax()
            ? $this->apiResponseSuccess($data)
            : redirect()->route('user.index')->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $user_id)
    {
        $this->repository->delete($user_id);

        return $request->wantsJson() || $request->ajax()
            ? $this->apiResponseSuccess('User deleted successfully')
            : redirect()->route('user.index')->with('success', 'User deleted successfully');
    }
}
