@extends('layouts.masterTemplate')

@section('title', 'Rekomendasi Rehabilitasi Sosial')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Rekomendasi Rehabilitasi Sosial</h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-primary float-right"
                       href="{{ route('rekomendasi_rehabilitasi_sosials.create') }}">
                        Add New
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
            @include('rekomendasi_rehabilitasi_sosials.table')
        </div>
    </div>

@endsection
