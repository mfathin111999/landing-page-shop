<?php

namespace App\Http\Controllers;

use App\Data\DashboardRepository;
use App\Data\StoreRepository;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $repository, $storeRepository;

    public function __construct(DashboardRepository $repository, StoreRepository $storeRepository)
    {
        $this->storeRepository = $storeRepository;
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $stores = $this->storeRepository->getStoreByUser($request->user()->id, $request);
        $totalOrders = $this->repository->getTotalPriceOrders($request);
        $totalIncome = $this->repository->getTotalPriceIncome($request);
        $totalSellItems = $this->repository->getQuantityOrders($request);

        // dd($request->all());

        $fee = $totalOrders - $totalIncome;
        $totalActualIncome = $totalIncome - 0;

        $totalOrders = number_format($totalOrders, 0, ',', '.');
        $totalIncome = number_format($totalIncome, 0, ',', '.');
        $totalSellItems = number_format($totalSellItems, 0, ',', '.');

        $fee = number_format($fee, 0, ',', '.');
        $totalActualIncome = number_format($totalActualIncome, 0, ',', '.');

        return view('dashboard', compact('totalOrders', 'totalIncome', 'totalSellItems', 'fee', 'stores', 'totalActualIncome'));
    }
}
