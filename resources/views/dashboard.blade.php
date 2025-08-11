@extends('layouts.admin')

@section('page-content')
    <!-- Dashboard Content -->
    <div class="mt-4">
        <div class="row">
            <div class="col-12 mb-4">
                <form action="{{ route('dashboard') }}" method="GET" id="filter-form">
                    <div class="d-flex align-item-center justify-content-between flex-wrap">
                        <div class="col-3">
                            <select class="form-select form-select-sm" id="store_id" name="store_id" onchange="submitForm()">
                                <option value="">Store</option>
                                @foreach ($stores as $id => $name)
                                    <option value="{{ $id }}" {{ $id == request('store_id') ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-3 d-flex">
                            <select class="form-select form-select-sm me-2" id="" name="year" onchange="submitForm()">
                                <option value="">Year</option>
                                @foreach (range(2023, date('Y')) as $year)
                                    <option value="{{ $year }}" {{ $year == (request('year') ?? date('Y')) ? 'selected' : '' }}>{{ $year }}</option>
                                @endforeach
                            </select>
                            <select class="form-select form-select-sm" id="" name="month" onchange="submitForm()">
                                <option value="">Month</option>
                                @foreach (range(1, 12) as $month)
                                    <option value="{{ $month }}" {{ $month == (request('month') ?? date('m')) ? 'selected' : '' }}>{{ $month }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-4">
                <div class="border border-secondary-subtle shadow-sm rounded d-flex align-items-center py-4">
                    <div class="px-4">
                        <div class="circle-rounde-logo bg-warning text-white">
                            <i class="fa fa-dollar-sign"></i>
                        </div>
                    </div>
                    <div>
                        <p class="text-start h3 logo-text-warning fw-bold mb-0">{{ $totalSellItems }}</p>
                        <p class="mb-0 text-muted">Selled Product</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="border border-secondary-subtle shadow-sm rounded d-flex align-items-center py-4">
                    <div class="px-4">
                        <div class="circle-rounde-logo bg-danger text-white">
                            <i class="fa-solid fa-money-bill-transfer"></i>
                        </div>
                    </div>
                    <div>
                        <p class="text-start h3 logo-text-warning fw-bold mb-0">Rp. {{ $totalOrders }}</p>
                        <p class="mb-0 text-muted">Total Revenue</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="border border-secondary-subtle shadow-sm rounded d-flex align-items-center py-4">
                    <div class="px-4">
                        <div class="circle-rounde-logo bg-info text-white">
                            <i class="fa-solid fa-wallet"></i>
                        </div>
                    </div>
                    <div>
                        <p class="text-start h3 logo-text-warning fw-bold mb-0">Rp. {{ $totalIncome }}</p>
                        <p class="mb-0 text-muted">Total Income</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-4">
                <div class="border border-secondary-subtle shadow-sm rounded d-flex align-items-center py-4">
                    <div class="px-4">
                        <div class="circle-rounde-logo bg-success-subtle">
                            <i class="fa fa-dollar-sign"></i>
                        </div>D0ng0000!
                    </div>
                    <div>
                        <p class="text-start h3 logo-text-warning fw-bold mb-0">Rp. {{ $fee }}</p>
                        <p class="mb-0 text-muted">Admin Fee</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="border border-secondary-subtle shadow-sm rounded d-flex align-items-center py-4">
                    <div class="px-4">
                        <div class="circle-rounde-logo bg-dark-subtle">
                            <i class="fa-solid fa-money-bill-transfer"></i>
                        </div>
                    </div>
                    <div>
                        <p class="text-start h3 logo-text-warning fw-bold mb-0">Rp. 0</p>
                        <p class="mb-0 text-muted">Total Production Price</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="border border-secondary-subtle shadow-sm rounded d-flex align-items-center py-4">
                    <div class="px-4">
                        <div class="circle-rounde-logo bg-info-subtle">
                            <i class="fa-solid fa-wallet"></i>
                        </div>
                    </div>
                    <div>
                        <p class="text-start h3 logo-text-warning fw-bold mb-0">Rp. {{ $totalActualIncome }}</p>
                        <p class="mb-0 text-muted">Total Actual Income</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-js')
    <script>
        function submitForm() {
            document.querySelector('#filter-form').submit();
        }
    </script>
@endsection
