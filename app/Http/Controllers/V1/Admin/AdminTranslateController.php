<?php

namespace App\Http\Controllers\V1\Admin;

use App\Http\Controllers\Controller;

use App\Data\TranslateRepository;
use App\Http\Requests\StoreTranslateRequest;
use App\Http\Requests\UpdateTranslateRequest;
use Illuminate\Http\Request;

class AdminTranslateController extends Controller
{
    protected $repository;

    public function __construct(TranslateRepository $repository)
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
            : view('master.translate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTranslateRequest $request)
    {
        $data = $this->repository->store($request);

        return $request->wantsJson() || $request->ajax()
            ? $this->apiResponseSuccess($data)
            : redirect()->route('translate.index')->with('success', 'Translate created successfully');
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTranslateRequest $request, $store_id)
    {
        $data = $this->repository->update($request, $store_id);

        return $request->wantsJson() || $request->ajax()
            ? $this->apiResponseSuccess($data)
            : redirect()->route('translate.index')->with('success', 'Translate updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $store_id)
    {
        $this->repository->delete($store_id);

        return $request->wantsJson() || $request->ajax()
            ? $this->apiResponseSuccess('Translate deleted successfully')
            : redirect()->route('translate.index')->with('success', 'Translate deleted successfully');
    }
}
