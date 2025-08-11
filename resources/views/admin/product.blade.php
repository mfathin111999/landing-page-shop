@extends('layouts.admin')

@section('page-css')
    @include('layouts.datatable_header')
@endsection

@section('page-title')
    {{ __('trans.product') }}
@endsection

@section('page-content')
    <!-- Table Content -->
    <div class="bg-white rounded-1 border shadow-sm">
        <table class="table table-bordered" id="datatable" width="100%">
            <thead class="table-carkensaku">
                <tr>
                    <th class="text-center">{{ __('trans.no') }}</th>
                    <th>{{ __('trans.name') }}</th>
                    <th>{{ __('trans.sku') }}</th>
                    <th>{{ __('trans.sku_ref') }}</th>
                    <th>{{ __('trans.variant') }}</th>
                    <th>{{ __('trans.price_selling') }}</th>
                    <th>{{ __('trans.price_cost') }}</th>
                    <th>{{ __('trans.quantity') }}</th>
                    <th>{{ __('trans.store') }}</th>
                </tr>
            </thead>
        </table>
    </div>

    {{-- Form --}}
    <div class="modal fade" id="modal-form" aria-labelledby="modal-form-label" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form v-on:submit.prevent="submit">
                    <div class="modal-header bg-carkensaku">
                        <h1 class="modal-title fs-5" id="modal-form-label">{{ __('trans.product') }}</h1>
                        <button class="btn-close" data-bs-dismiss="modal" type="button" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="mb-3 col-12">
                                <label class="form-label" for="name">{{ __('trans.name') }}</label>
                                <input class="form-control" id="name" name="name" type="text" v-model="form.name">
                            </div>
                            <div class="mb-3 col-6">
                                <label class="form-label" for="sku">{{ __('trans.sku') }}</label>
                                <input class="form-control" id="sku" name="sku" type="text" v-model="form.sku">
                            </div>
                            <div class="mb-3 col-6">
                                <label class="form-label" for="sku_ref">{{ __('trans.sku_ref') }}</label>
                                <input class="form-control" id="sku_ref" name="sku_ref" type="text" v-model="form.sku_ref">
                            </div>
                            <div class="mb-3 col-12">
                                <label class="form-label" for="variant">{{ __('trans.variant') }}</label>
                                <input class="form-control" id="variant" name="variant" type="text" v-model="form.variant">
                            </div>
                            <div class="mb-3 col-6">
                                <label class="form-label" for="price_selling">{{ __('trans.price_selling') }}</label>
                                <input class="form-control" id="price_selling" name="price_selling" type="text" v-model="form.price_selling">
                            </div>
                            <div class="mb-3 col-6">
                                <label class="form-label" for="price_cost">{{ __('trans.price_cost') }}</label>
                                <input class="form-control" id="price_cost" name="price_cost" type="text" v-model="form.price_cost">
                            </div>
                            <div class="mb-3 col-6">
                                <label class="form-label" for="quantity">{{ __('trans.quantity') }}</label>
                                <input class="form-control" id="quantity" name="quantity" type="text" v-model="form.quantity">
                            </div>
                            <div class="mb-3 col-6">
                                <label class="form-label" for="store">{{ __('trans.store') }}</label>
                                <select class="form-select" id="store_id" name="store_id" v-model="form.store_id">
                                    <option value="" disabled>{{ __('trans.select_store') }}</option>
                                    @foreach ($stores as $key => $store)
                                        <option value="{{ $key }}">{{ $store }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-between">
                        <div>
                            <button class="btn border btn-light btn-sm text-danger" type="button" v-if="status" v-on:click="destroy(form.id)">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                        <div>
                            <button class="btn btn-secondary me-2" data-bs-dismiss="modal" type="button">{{ __('button.close') }}</button>
                            <button class="btn btn-carkensaku" type="submit">{{ __('button.save') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('page-js')
    <script>
        var options = {
            'clicked': true,
            'buttons': ['add', 'reload'],
            'columns': [{
                    data: 'DT_RowIndex',
                    class: 'text-center',
                    width: '20px',
                    searchable: false,
                    sortable: false
                },
                {
                    data: 'name',
                    class: 'text-center',
                    searchable: true,
                    sortable: true
                },
                {
                    data: 'sku',
                    class: 'text-center',
                    searchable: true,
                    sortable: true
                },
                {
                    data: 'sku_ref',
                    class: 'text-center',
                    searchable: true,
                    sortable: true
                },
                {
                    data: 'variant',
                    class: 'text-center',
                    searchable: true,
                    sortable: true
                },
                {
                    data: 'price_selling',
                    class: 'text-center',
                    searchable: true,
                    sortable: true
                },
                {
                    data: 'price_cost',
                    class: 'text-center',
                    searchable: true,
                    sortable: true
                },
                {
                    data: 'quantity',
                    class: 'text-center',
                    searchable: true,
                    sortable: true
                },
                {
                    data: 'store_id',
                    class: 'text-center',
                    searchable: true,
                    sortable: true
                },
            ],
        };
    </script>
    @include('layouts.datatable')
    @include('layouts.datatable_mount')
@endsection
