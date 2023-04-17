@extends('layouts.masterTemplate')

@section('title', 'Detail Pengaduan')

@section('content')

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>

    <style>
        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
    
        .card-header h3 {
            margin: 0;
        }
    
        .card-header a {
            margin-left: 10px;
        }
    </style>
    <?php
    use Carbon\Carbon;
    
    $birthdatestring = $rekomendasiTerdaftarYayasan->tgl_lahir;
    $birthdatestring = substr($birthdatestring, 0, 10);
    $birthdate = Carbon::parse($birthdatestring);
    ?>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">

            </div>
        </div>
    </section>

    <div class="content px-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="card-header pb-0">
                        <h2>
                            Detail Rekomendasi Yayasan
                        </h2>
                        <a href="{{ route('rekomendasi_terdaftar_yayasans.index') }}" class="btn btn-primary ml-2">Kembali</a>
                    </div>
                    <div class="card-body">
                        @include('rekomendasi_terdaftar_yayasans.show_fields')
                    </div>
                    <hr class="border horizontal dark">
                    <div class="card-footer">
                        <h3>Riwayat</h3>
                        <br>
                        {{-- log pengaduan --}}
                        <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="text-center">Time Stamp</th>
                                    <th class="text-center">Oleh</th>
                                    <th class="text-center">Aksi</th>
                                    <th class="text-center">Catatan</th>
                                    <th class="text-center">File Penunjang</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                suu
                            </tbody>
                        </table>
                        <br>
                        <a class="btn btn-primary" style="float: right"
                            href="{{ route('rekomendasi_terdaftar_yayasans.index') }}">
                            @lang('kembali')
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
