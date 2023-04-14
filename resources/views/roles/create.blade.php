{{-- @extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Create New Role</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('roles.index') }}"> Back </a>
        </div>
    </div>
</div>


@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong> Something went wrong.<br><br>
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif

{!! Form::open(array('route' => 'roles.store','method'=>'POST')) !!}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Name:</strong>
            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Permission:</strong>
            <br/>
            @foreach($permission as $value)
                <label>{{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
                {{ $value->name }}</label>
            <br/>
            @endforeach
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
{!! Form::close() !!}

@endsection --}}
@extends('layouts.masterTemplate')
@section('content')
    @if ($message = Session::get('masuk'))
    <div class="alert alert-success">
        <a class="close" data-dismiss="alert">×</a>
        <p>{{ $message }}</p>
        <img src="close.soon" style="display:none;" onerror="(function(el){ setTimeout(function(){ el.parentNode.parentNode.removeChild(el.parentNode); },2000 ); })(this);" />
    </div>
    @endif
    @if ($message = Session::get('deleted'))
    <div class="alert alert-danger">
        <a class="close" data-dismiss="alert">×</a>
        <p>{{ $message }}</p>
        <img src="close.soon" style="display:none;" onerror="(function(el){ setTimeout(function(){ el.parentNode.parentNode.removeChild(el.parentNode); },2000 ); })(this);" />
    </div>
    @endif
    {!! Form::open(array('route' => 'roles.store','method'=>'POST')) !!}
        {!! Form::text('name_roles', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
        <div class="card mt-4">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div class="p-2 bd-highlight">Create Role</div>
                    
                    <div class="p-2 bd-highlight">
                        <ul class="list-group list-group-unbordered center">
                            <a class="btn btn-primary" href="{{ route('roles.index') }}"> kembali</a>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="card-body">              
                <div class="row">
                 
                    @foreach($permission as $value)
                        
                        <div class="col-sm-2 mt-4">
                            <div class="content">
                                <ul class="list-group">
                                    <li class="list-group-item">  
                                        <label> 
                                            <label>{{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
                                            {{ $value->name }}</label>
                                        <br/>
                                        </label>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <ul class="list-group list-group-unbordered mb-3 center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </ul>
        </div>
    {!! Form::close() !!}
@endsection