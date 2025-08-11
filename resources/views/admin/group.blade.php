@extends('layouts.admin')

@section('page-css')
    @include('layouts.datatable_header')
@endsection

@section('page-title')
    {{ __('trans.group') }}
@endsection

@section('page-content')
    <!-- Table Content -->
    <div class="bg-white rounded-1 border shadow-sm">
        <table class="table table-bordered" id="datatable" width="100%">
            <thead class="table-carkensaku">
                <tr>
                    <th class="text-center">{{ __('trans.no') }}</th>
                    <th>{{ __('trans.name') }}</th>
                    <th>{{ __('trans.owner') }}</th>
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
                    data: 'owner_name',
                    name: 'users.name',
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
