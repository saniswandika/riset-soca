@extends('layouts.masterTemplate')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>
                    @lang('Detail Rekomendasi Biaya Perawatan') 
                    </h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-default float-right"
                       href="{{ route('rekomendasi_biaya_perawatans.index') }}">
                                                    @lang('back')
                                            </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    @include('rekomendasi_biaya_perawatans.show_fields')
                </div>
            </div>
        </div>
    </div>
@endsection
