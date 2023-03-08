@extends('layouts.masterTemplate')

@section('title', 'Buat Pengaduan')

@section('content')
        <div class="card">

            {!! Form::open(['route' => 'pengaduans.store','method' => 'POST']) !!}

            <div class="card-body shadow-lg">

                    @include('pengaduans.fields')

                    <a href="{{ route('pengaduans.index') }}" class="btn btn-warning"> Batal </a>
                    <a href="#" class="btn btn-secondary"> Draft </a>
                    <button class="btn btn-primary" type="submit">Save</button>
            </div>

                
                
            {!! Form::close() !!}

        </div>
    </div>
@endsection
