@extends('layouts.masterTemplate')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>
                    Buat Pengaduan
                    </h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3 shadow-lg">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::open(['route' => 'pengaduans.store']) !!}

            <div class="card-body shadow-lg">

                    @include('pengaduans.fields')

            </div>

            <div class="card-footer">
                <a href="{{ route('pengaduans.index') }}" class="btn btn-default"> Batal </a>
                {!! Form::submit('Draft', ['class' => 'btn btn-default']) !!}
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
