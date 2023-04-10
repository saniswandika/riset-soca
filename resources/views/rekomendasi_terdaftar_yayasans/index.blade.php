@extends('layouts.masterTemplate')

@section('title', 'Menu Layanan')

@section('content')

    {{-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.css"/> --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap5.css" />

    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/js/C"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.5/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap5.js"></script>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Table Rekomendasi Yayasan</h6>
                </div>
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <?php
                            $userid = Auth::user()->id;
                            $usersrole = DB::table('model_has_roles')
                                ->leftJoin('users', 'users.id', '=', 'model_has_roles.model_id')
                                ->leftJoin('roles', 'roles.id', '=', 'model_has_roles.role_id')
                                ->where('model_id', $userid)
                                ->get();
                            // dd($usersrole);
                            ?>
                            @foreach ($usersrole as $item)
                                @if ($item->name == 'fasilitator' || $item->name == 'Front Office kota')
                                    <li class="nav-item">
                                        <a class="nav-link" id="tabdraft" data-toggle="tab" href="#table1" role="tab"
                                            aria-controls="table1" aria-selected="true">Draft</a>
                                    </li>
                                @endif
                            @endforeach

                            <li class="nav-item">
                                <a class="nav-link" id="tabproses" data-toggle="tab" href="#table2" role="tab"
                                    aria-controls="table2" aria-selected="false">Diproses</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tabteruskan" data-toggle="tab" href="#table4" role="tab"
                                    aria-controls="table4" aria-selected="false">Teruskan</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tabselesai" data-toggle="tab" href="#table3" role="tab"
                                    aria-controls="table3" aria-selected="false">Selesai</a>
                            </li>
                            @auth
                                <li class="nav-item ml-auto" style="margin-left: auto">
                                    <a href="rekomendasi_terdaftar_yayasans/create" class="btn btn-primary ml-2">Tambah Data</a>
                                </li>
                            @endauth

                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show table-responsive" id="table1" role="tabpanel"
                                aria-labelledby="tabdraft" style="margin-top: 20px;">
                                <table id="draft" class="table table-striped table-bordered dt-responsive nowrap"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Lembaga</th>
                                            <th>Ketua Yayasan</th>
                                            <th>NIK</th>
                                            <th>Nama Terlapor</th>
                                            <th>Alamat</th>
                                            <th>Status</th>
                                            <th>Tujuan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade table-responsive" id="table2" role="tabpanel"
                                aria-labelledby="tabproses" style="margin-top: 20px;">
                                <table id="diproses" class="table table-striped dt-responsive table-bordered nowrap"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Lembaga</th>
                                            <th>Ketua Yayasan</th>
                                            <th>NIK</th>
                                            <th>Nama Terlapor</th>
                                            <th>Alamat</th>
                                            <th>Status</th>
                                            <th>Tujuan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- di isi di ajax --}}
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade table-responsive" id="table3" role="tabpanel"
                                aria-labelledby="tabteruskan" style="margin-top: 20px;">
                                <table id="teruskan" class="table table-striped table-bordered dt-responsive nowrap"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Lembaga</th>
                                            <th>Ketua Yayasan</th>
                                            <th>NIK</th>
                                            <th>Nama Terlapor</th>
                                            <th>Alamat</th>
                                            <th>Status</th>
                                            <th>Tujuan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- di isi di ajax --}}
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade table-responsive" id="table4" role="tabpanel"
                                aria-labelledby="tabselesai" style="margin-top: 20px;">
                                <table id="selesai" class="table table-striped table-bordered dt-responsive nowrap"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Lembaga</th>
                                            <th>Ketua Yayasan</th>
                                            <th>NIK</th>
                                            <th>Nama Terlapor</th>
                                            <th>Alamat</th>
                                            <th>Status</th>
                                            <th>Tujuan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- di isi di ajax --}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endsection
