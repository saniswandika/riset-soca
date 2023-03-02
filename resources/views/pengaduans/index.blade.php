@extends('layouts.masterTemplate')

@push('style')
@livewireStyles
@endpush
@push('script')
@livewireScripts
@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Pengaduan</h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-primary float-right"
                       href="{{ route('pengaduans.create') }}">
                        Add New
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>
        @livewire('pengaduan-table')
        {{-- <div class="card">
            @include('pengaduans.table')
        </div> --}}
    </div>
@endsection
