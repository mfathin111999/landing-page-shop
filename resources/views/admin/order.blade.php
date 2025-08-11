@extends('layouts.admin')

@section('page-title', 'Order Upload')

@section('page-content')
    {{-- TABLE=CONTENT --}}
    <form id="form" method="POST" enctype="multipart/form-data" action="{{ route('order.import') }}">
        @csrf
        <div class="row align-items-center justify-content-center mt-4">
            <div class="col-12">
                <div class="bg-white rounded-4 border shadow-sm p-4 wrapper">

                    <div class="mb-2">
                        <label for="store_id">{{ __('trans.store') }}</label>
                        <select class="form-select form-select-sm" id="store_id" id="store_id" name="store_id" required>
                            <option value="">{{ __('trans.choose_store') }}</option>
                            @foreach ($stores as $key => $store)
                                <option value="{{ $key }}">{{ $store }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-5">
                        <label for="file">{{ __('trans.file') }}</label>
                        <input class="form-control form-control-sm" id="file" name="file" type="file" required>
                    </div>

                    <button class="btn btn-warning w-100" type="submit">{{ __('trans.action.save') }}</button>
                </div>

            </div>
        </div>
    </form>
@endsection

@section('page-js')
    <script>
        console.log('Dashboard loaded successfully');
    </script>
@endsection
