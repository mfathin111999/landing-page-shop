<?php

namespace App\Http\Controllers\V1\User;

use App\Http\Controllers\Controller;

use App\Data\ProductRepository;
use App\Data\StoreRepository;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $repository;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, StoreRepository $storeRepository)
    {
        return $request->wantsJson() || $request->ajax()
            ? $this->repository->call($request)
            : view('admin.product', [
                'stores' => $storeRepository->list(),
            ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $data = $this->repository->store($request->only('name', 'sku', 'sku_ref', 'variant', 'price_selling', 'price_cost', 'quantity', 'store_id'));

        return $request->wantsJson() || $request->ajax()
            ? $this->apiResponseSuccess($data)
            : redirect()->route('product.index')->with('success', 'Product created successfully');
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, $product_id)
    {
        $data = $this->repository->update($request->only('name', 'sku', 'sku_ref', 'variant', 'price_selling', 'price_cost', 'quantity', 'store_id'), $product_id);

        return $request->wantsJson() || $request->ajax()
            ? $this->apiResponseSuccess($data)
            : redirect()->route('product.index')->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $product_id)
    {
        $this->repository->delete($product_id);

        return $request->wantsJson() || $request->ajax()
            ? $this->apiResponseSuccess('Product deleted successfully')
            : redirect()->route('product.index')->with('success', 'Product deleted successfully');
    }
}
