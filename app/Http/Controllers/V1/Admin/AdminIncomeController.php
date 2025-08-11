<?php

namespace App\Http\Controllers\V1\Admin;

use App\Http\Controllers\Controller;

use App\Data\IncomeRepository;
use App\Data\StoreRepository;
use App\Http\Requests\StoreIncomeRequest;
use App\Http\Requests\UpdateIncomeRequest;
use Illuminate\Http\Request;

class AdminIncomeController extends Controller
{
    protected $repository;
    public function __construct(IncomeRepository $repository)
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
            : view('master.income');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreIncomeRequest $request)
    {
        $data = $this->repository->store($request);

        return $request->wantsJson() || $request->ajax()
            ? $this->apiResponseSuccess($data)
            : redirect()->route('income.index')->with('success', 'Income created successfully');
    }

    /**
     * Show the form for uploading incomes.
     */
    public function upload(Request $request, StoreRepository $storeRepository)
    {
        return view('admin.income', [
            'stores' => $storeRepository->list(),
        ]);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateIncomeRequest $request, $income_id)
    {
        $data = $this->repository->update($request, $income_id);

        return $request->wantsJson() || $request->ajax()
            ? $this->apiResponseSuccess($data)
            : redirect()->route('income.index')->with('success', 'Income updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $income_id)
    {
        $this->repository->delete($income_id);

        return $request->wantsJson() || $request->ajax()
            ? $this->apiResponseSuccess('Income deleted successfully')
            : redirect()->route('income.index')->with('success', 'Income deleted successfully');
    }
}
