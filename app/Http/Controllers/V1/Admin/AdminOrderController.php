<?php

namespace App\Http\Controllers\V1\Admin;

use App\Http\Controllers\Controller;

use App\Data\OrderRepository;
use App\Data\StoreRepository;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    protected $repository;

    public function __construct(OrderRepository $repository)
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
            : view('master.order');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        $data = $this->repository->store($request);

        return $request->wantsJson() || $request->ajax()
            ? $this->apiResponseSuccess($data)
            : redirect()->route('order.index')->with('success', 'Order created successfully');
    }

    /**
     * Show the form for uploading orders.
     */
    public function upload(Request $request, StoreRepository $storeRepository)
    {
        return view('admin.order', [
            'stores' => $storeRepository->list(),
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, $order_id)
    {
        $data = $this->repository->update($request, $order_id);

        return $request->wantsJson() || $request->ajax()
            ? $this->apiResponseSuccess($data)
            : redirect()->route('order.index')->with('success', 'Order updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $order_id)
    {
        $this->repository->delete($order_id);

        return $request->wantsJson() || $request->ajax()
            ? $this->apiResponseSuccess('Order deleted successfully')
            : redirect()->route('order.index')->with('success', 'Order deleted successfully');
    }
}