@extends('layouts.masterTemplate')

@section('title', 'Pengaturan wilayah')

@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" ></script> 
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css"  /> --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap5.css"/>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/js/C"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.5/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap5.js"></script>
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
            <div class="tab-pane fade show table-responsive" id="table1" role="tabpanel" aria-labelledby="tab1" style="margin-top: 20px;">
            <table class="table table-striped dt-responsive nowrap" id="datatable">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Provinsi</th>
                    <th>Kabupaten/Kota</th>
                    <th>kecamatan</th>
                    <th>Kelurahan</th>
                    <th>Status</th>
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
</div>
<script>
    $(document).ready(function() {
    var table = $('#datatable').DataTable( {
        responsive: true
    } );
 
    new $.fn.dataTable.FixedHeader( table );
} );
</script>
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
                    location.reload()
                }
            });
        });
    });
</script>
@endsection