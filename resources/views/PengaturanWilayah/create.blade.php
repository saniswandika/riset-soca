@extends('layouts.masterTemplate')


@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<div class="container">
    <div class="card">
        <div class="card-body">
            @if (session('success'))
                <p class="alert alert-success">{{ session('success') }}</p>
            @endif
            <div class="container">
                {!! Form::open(['route' => 'add_wilayah.store', 'method' => 'POST']) !!}
                    <div class="row mb-3">
                        <label class="col-md-3 col-form-label" for="provinsi">Provinsi</label>
                        <div class="col-md-9">
                            <select class="form-control " name="province_id" id="provinsi" required>
                                <option>==Pilih Salah Satu==</option>
                                @foreach ($province as $item)
                                    <option value="{{ $item->code ?? '' }}">{{ $item->name_prov ?? '' }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-md-3 col-form-label kota" for="kota">Kabupaten / Kota</label>
                        <div class="col-md-9">
                            <select class="form-control" name="kota_id" id="kota" required>
                                <option>==Pilih Salah Satu==</option>
                                {{-- @foreach ($kota as $item) --}}
                                    {{-- <option value="{{ $item->id ?? '' }}">{{ $item->name ?? '' }}</option>
                                @endforeach --}}
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-md-3 col-form-label kecamatan" for="kecamatan">Kecamatan</label>
                        <div class="col-md-9">
                            <select class="form-control" name="kecamatan_id" id="kecamatan">
                                <option value="">==Pilih Salah Satu==</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-md-3 col-form-label" for="Kelurahan">Kelurahan</label>
                        <div class="col-md-9">
                            <select class="form-control" name="kelurahan_id" id="Kelurahan" required>
                                <option>==Pilih Salah Satu==</option>
                                {{-- @foreach ($kelurahans as $item)
                                    <option value="{{ $item->id ?? '' }}">{{ $item->name ?? '' }}</option>
                                @endforeach --}}
                            </select>
                        </div>
                    </div>
                    <button class="btn btn-primary float-right mt-5">Tambahkan Wilayah</button>
                {!! Form::close() !!}
                {{-- <div class="row mb-3">
                    <label class="col-md-3 col-form-label" for="status">status</label>
                    <div class="col-md-9">
                        <input data-id="{{$product->id}}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $product->status ? 'checked' : '' }}>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
</div>

 
     
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script>
    $(document).ready(function() {
        $('.form-control').select2();
    });
  </script>
    <script>
       // Memuat data kota setelah provinsi dipilih
        $(document).ready(function() {
            $('#provinsi').on('change', function() {
                var provinsiId = $(this).val();
                if(provinsiId) {
                    $.ajax({
                            url: '{{ route("getKota") }}',
                            type: 'POST',
                            data: {
                            "_token": "{{ csrf_token() }}",
                            "provinsi": provinsiId
                        },
                        dataType: 'JSON',
                        success: function(data) {
                        $('#kota').empty();
                            $.each(data, function(key, value) {
                                $('#kota').append('<option value="'+ value.code +'">'+ value.name_cities +'</option>');
                               
                            });
                        }
                });
                } else {
                $('#kota').empty();
                }
            });
        });
        
    </script>
     <script>
        $('#kota').change(function () {
            var regencyId = $(this).val();
            
            $.ajax({
                url: '/kecamatan/getByRegency/' + regencyId,
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    // console.log(data);
                    $('#kecamatan').empty();

                    $.each(data, function (key, value) {
                        $('#kecamatan').append('<option value="' + value.code + '">' + value.name_districts + '</option>');
                    });
                }
            });
        });
     </script>
     <script>
        $('#kecamatan').change(function () {
            var kelurahanId = $(this).val();
            
            $.ajax({
                url: '/kelurahan/getByRegency/' + kelurahanId,
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    // console.log(data);
                    $('#Kelurahan').empty();

                    $.each(data, function (key, value) {
                        $('#Kelurahan').append('<option value="' + value.code + '">' + value.name_village + '</option>');
                    });
                }
            });
        });
     </script>
    @endsection
