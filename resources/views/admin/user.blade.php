@extends('layouts.admin')

@section('page-css')
    @include('layouts.datatable_header')
@endsection

@section('page-title')
    {{ __('trans.setting') }}
@endsection

@section('page-content')
    <div class="row">
        <div class="col-6">
            <div class="bg-white rounded-1 border shadow-sm p-3 d-flex align-items-center flex-wrap">
                <div class="col-12">
                    <label class="h4 fw-bold" for="name">{{ __('trans.profile') }}</label>
                </div>
                <div class="col-12">
                    <label for="name">{{ __('trans.name') }}</label>
                    <input class="form-control form-control-sm mb-3" name="name" id="name" type="text" placeholder="{{ __('trans.placeholder_name') }}">
                </div>
                <div class="col-12">
                    <label for="name">{{ __('trans.name') }}</label>
                    <input class="form-control form-control-sm mb-3" name="name" id="name" type="text" placeholder="{{ __('trans.placeholder_name') }}">
                </div>
                <div class="col-12">
                    <label for="name">{{ __('trans.name') }}</label>
                    <input class="form-control form-control-sm mb-3" name="name" id="name" type="text" placeholder="{{ __('trans.placeholder_name') }}">
                </div>
                <div class="col-12">
                    <label for="name">{{ __('trans.name') }}</label>
                    <input class="form-control form-control-sm mb-3" name="name" id="name" type="text" placeholder="{{ __('trans.placeholder_name') }}">
                </div>
            </div>
        </div>
    </div>
@endsection
