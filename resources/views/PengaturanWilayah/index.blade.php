@extends('layouts.masterTemplate')

@section('title', 'Pengaturan wilayah')

@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" ></script> 
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css"  /> --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js"></script>
<div class="container">
    <div class="card">
        <div class="card-body">
            @if (session('success'))
                <p class="alert alert-success">{{ session('success') }}</p>
            @endif
            <div class="col-sm-12">
                <div class="col-sm-12">
                    <a class="btn btn-primary float-right mb-2"
                       href="{{ route('rubahwilayah') }}">
                        Add New
                    </a>
                </div>
            </div>
            <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Provinsi</th>
                    <th scope="col">Kabupaten/Kota</th>
                    <th scope="col">kecamatan</th>
                    <th scope="col">Kelurahan</th>
                    <th scope="col">Status</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($wilayah as $key => $wilayah)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $wilayah->name_prov }}</td>
                            <td>{{ $wilayah->name_cities }}</td>
                            <td>{{ $wilayah->name_village }}</td>
                            <td>{{ $wilayah->name_districts }}</td>
                            <td>
                                <input type="checkbox" data-id="{{ $wilayah->id }}" name="status_wilayah" class="js-switch" {{ $wilayah->status_wilayah == 1 ? 'checked' : '' }}>
                            </td>
                            <td>
                                {{-- <a class="btn btn-info" href="{{ route('wilayah.show',$role->id) }}">Show</a>
                                @can('role-edit')
                                    <a class="btn btn-primary" href="{{ route('wilayah.edit',$role->id) }}">Edit</a>
                                @endcan
                                @can('role-delete')
                                    {!! Form::open(['method' => 'DELETE','route' => ['wilayah.destroy', $role->id],'style'=>'display:inline']) !!}
                                        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                    {!! Form::close() !!}
                                @endcan --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    let elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

    elems.forEach(function(html) {
        let switchery = new Switchery(html,  { size: 'small' });
    });
    $(document).ready(function(){
        $('.js-switch').change(function () {
            let status_wilayah = $(this).prop('checked') === true ? 1 : 0;
            let wilayahId = $(this).data('id');
            $.ajax({
                type: "GET",
                dataType: "json",
                url: '{{ route('users.update.status') }}',
                data: {'status_wilayah': status_wilayah, 'wilayah_Id': wilayahId},
                success: function (data) {
                    console.log(data.message);
                }
            });
        });
    });
</script>
@endsection