<?php

namespace App\Data;

use App\Models\Income;
use App\Models\Order;

class DashboardRepository
{
    public function getTotalPriceIncome($request)
    {
        return Income::when($request->filled('store_id'), function ($query) use ($request) {
            $query->where('store_id', $request->store_id);
        })
            ->when($request->input('type', 'monthly') == 'monthly', function ($query) use ($request) {
                $query->whereYear('date', $request->year ?? date('Y'))
                    ->whereMonth('date', $request->month ?? date('m'));
            }, function ($query) use ($request) {
                $query->whereDate('date', '>=', $request->date_start ?? date('Y-m-d'))
                    ->whereDate('date', '<=', $request->date_end ?? date('Y-m-d', strtotime('+1 month')));
            })
            ->sum('total');
    }

    public function getTotalPriceOrders($request)
    {
        return Order::when($request->filled('store_id'), function ($query) use ($request) {
            $query->where('store_id', $request->store_id);
        })
            ->when($request->input('type', 'monthly') == 'monthly', function ($query) use ($request) {
                $query->whereYear('date_finished', $request->year ?? date('Y'))
                    ->whereMonth('date_finished', $request->month ?? date('m'));
            }, function ($query) use ($request) {
                $query->whereDate('date_finished', '>=', $request->date_start ?? date('Y-m-d'))
                    ->whereDate('date_finished', '<=', $request->date_end ?? date('Y-m-d', strtotime('+1 month')));
            })
            ->sum('total');
    }

    public function getQuantityOrders($request)
    {
        return Order::when($request->filled('store_id'), function ($query) use ($request) {
            $query->where('store_id', $request->store_id);
        })
            ->when($request->input('type', 'monthly') == 'monthly', function ($query) use ($request) {
                $query->whereYear('date_finished', $request->year ?? date('Y'))
                    ->whereMonth('date_finished', $request->month ?? date('m'));
            }, function ($query) use ($request) {
                $query->whereDate('date_finished', '>=', $request->date_start ?? date('Y-m-d'))
                    ->whereDate('date_finished', '<=', $request->date_end ?? date('Y-m-d', strtotime('+1 month')));
            })
            ->sum('quantity');
    }

    public function getActualPrice($request)
    {
        return Order::select('orders.id', 'store_id', 'products.price_cost')
            ->join('products', 'products.sku', '=', 'orders.sku')
            ->when($request->filled('store_id'), function ($query) use ($request) {
                $query->where('store_id', $request->store_id);
            })
            ->when($request->input('type', 'monthly') == 'monthly', function ($query) use ($request) {
                $query->whereYear('date_finished', $request->year ?? date('Y'))
                    ->whereMonth('date_finished', $request->month ?? date('m'));
            }, function ($query) use ($request) {
                $query->whereDate('date_finished', '>=', $request->date_start ?? date('Y-m-d'))
                    ->whereDate('date_finished', '<=', $request->date_end ?? date('Y-m-d', strtotime('+1 month')));
            })
            ->sum('quantity');
    }
}
