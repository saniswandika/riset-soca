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
                <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title"></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        <button class="nav-link active" id="nav_detail-tab" data-bs-toggle="tab"
                                            data-bs-target="#nav_detail" type="button" role="tab"
                                            aria-controls="nav_detail" aria-selected="true">Detail Rekomendasi
                                            Yayasan</button>
                                        <button class="nav-link" id="nav_log-tab" data-bs-toggle="tab"
                                            data-bs-target="#nav_log" type="button" role="tab" aria-controls="nav_log"
                                            aria-selected="false">Log Rekomendasi Yayasan</button>
                                    </div>
                                </nav>
                                <div class="tab-content mt-4" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="nav_detail" role="tabpanel"
                                        aria-labelledby="nav_detail-tab">
                                    </div>
                                    <div class="tab-pane fade" id="nav_log" role="tabpanel" aria-labelledby="nav_log-tab">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
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
                            @foreach ($usersrole as $u)
                                @if ($u->name_roles == 'Front Office Kelurahan')
                                    <li class="nav-item">
                                        <a class="nav-link" id="tabdraft" data-toggle="tab" href="#tabledraft"
                                            role="tab" aria-controls="tabledraft" aria-selected="true">Draft</a>
                                    </li>
                                @endif
                            @endforeach
                            <li class="nav-item">
                                <a class="nav-link" id="tabproses" data-toggle="tab" href="#tableproses" role="tab"
                                    aria-controls="tableproses" aria-selected="false">Diproses</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tabteruskan" data-toggle="tab" href="#tableteruskan" role="tab"
                                    aria-controls="tableteruskan" aria-selected="false">Teruskan</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tabselesai" data-toggle="tab" href="#tableselesai" role="tab"
                                    aria-controls="tableselesai" aria-selected="false">Selesai</a>
                            </li>


                            <li class="nav-item ml-auto" style="margin-left: auto">
                                <a href="/rekomendasi_terdaftar_yayasans/create" class="btn btn-primary ml-2">Tambah
                                    Data</a>
                            </li>
                        </ul>

                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show table-responsive" id="tabledraft" role="tabpanel"
                                aria-labelledby="tabdraft" style="margin-top: 20px;">
                                <table id="draft" class="table table-striped table-bordered dt-responsive nowrap"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Lembaga</th>
                                            <th>Ketua</th>
                                            <th>NIK</th>
                                            <th>Nama Terlapor</th>
                                            <th>Alamat</th>
                                            <th>Status</th>
                                            <th>Tujuan</th>
                                            {{-- <th>Status</th>
                    <th>Durasi (hari)</th> --}}
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade table-responsive" id="tableproses" role="tabpanel"
                                aria-labelledby="tabproses" style="margin-top: 20px;">
                                <table id="proses" class="table table-striped dt-responsive table-bordered nowrap"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                        <tr>
                                            <th>No</th>
                                            <th>Lembaga</th>
                                            <th>Ketua</th>
                                            <th>NIK</th>
                                            <th>Nama Terlapor</th>
                                            <th>Alamat</th>
                                            <th>Status</th>
                                            <th>Tujuan</th>
                                            {{-- <th>Status</th>
                            <th>Durasi (hari)</th> --}}
                                            <th>Aksi</th>
                                        </tr>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- di isi di ajax --}}
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade table-responsive" id="tableteruskan" role="tabpanel"
                                aria-labelledby="tabteruskan" style="margin-top: 20px;">
                                <table id="teruskan" class="table table-striped table-bordered dt-responsive nowrap"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                        <tr>
                                            <th>No</th>
                                            <th>Lembaga</th>
                                            <th>Ketua</th>
                                            <th>NIK</th>
                                            <th>Nama Terlapor</th>
                                            <th>Alamat</th>
                                            <th>Status</th>
                                            <th>Tujuan</th>
                                            {{-- <th>Status</th>
                            <th>Durasi (hari)</th> --}}
                                            <th>Aksi</th>
                                        </tr>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- di isi di ajax --}}
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade table-responsive" id="tableselesai" role="tabpanel"
                                aria-labelledby="tabselesai" style="margin-top: 20px;">
                                <table id="selesai" class="table table-striped table-bordered dt-responsive nowrap"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                        <tr>
                                            <th>No</th>
                                            <th>Lembaga</th>
                                            <th>Ketua</th>
                                            <th>NIK</th>
                                            <th>Nama Terlapor</th>
                                            <th>Alamat</th>
                                            <th>Status</th>
                                            <th>Tujuan</th>
                                            {{-- <th>Status</th>
                            <th>Durasi (hari)</th> --}}
                                            <th>Aksi</th>
                                        </tr>
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



                {{-- <script>
    $('.selesai').DataTable({
        responsive: true,
    });
</script> --}}
                <script>
                    $(document).ready(function() {
                        $('#draft').DataTable({
                            processing: true,
                            serverSide: true,
                            ajax: {
                                url: '/draft-rekomendasi-terdaftar-yayasan',
                                type: 'GET',
                                dataSrc: 'data.data'
                            },
                            buttons: [{
                                text: 'My button',
                                action: function(e, dt, node, config) {
                                    alert('Button activated');
                                }
                            }],
                            // ajax: "{{ route('getdata') }}",
                            columns: [{
                                    data: 'no_pendaftaran',
                                    name: 'no_pendaftaran'
                                },
                                {
                                    data: 'nama_lembaga',
                                    name: 'nama_lembaga'
                                },
                                {
                                    data: 'nama_ketua',
                                    name: 'nama_ketua'
                                },
                                {
                                    data: 'nik_ter',
                                    name: 'nik_ter'
                                },
                                {
                                    data: 'nama_ter',
                                    name: 'nama_ter'
                                },
                                {
                                    data: 'alamat',
                                    name: 'alamat'
                                },
                                {
                                    data: 'status_alur',
                                    name: 'status_alur'
                                },
                                {
                                    data: 'tujuan',
                                    name: 'tujuan'
                                },
                                {
                                    data: null,
                                    className: "dt-center editor-delete",
                                    orderable: false,
                                    "mRender": function(data, type, row) {
                                        return '<div class="btn-group" role="group" aria-label="Actions">' +
                                            '<a class="btn btn-success btn-sm" href="/rekomendasi_terdaftar_yayasans/' +
                                            data.id + '"><i class="fas fa-eye"></i>   Details </a>' +
                                            '</div>' +
                                            '<div class="btn-group" role="group" aria-label="Actions">' +
                                            '<a class="btn btn-primary btn-sm" href="/rekomendasi_terdaftar_yayasans/' +
                                            data.id + '/edit""><i class="far fa-edit"></i></i>   Edit </a>' +
                                            '</div>' +
                                            '<div class="btn-group" role="group" aria-label="Actions">' +
                                            '<a class="btn btn-info btn-sm" href="/pdfyayasan/' + data.id +
                                            '"><i class="fas fa-print"></i>   Cetak Pendaftaran </a>' +
                                            '</div>';

                                    }
                                }
                            ],
                        });
                    });
                    $('#proses').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: {
                            url: '/diproses-rekomendasi-terdaftar-yayasan',
                            type: 'GET',
                            dataSrc: 'data.data'
                        },
                        columns: [{
                                data: 'no_pendaftaran',
                                name: 'no_pendaftaran'
                            },
                            {
                                data: 'nama_lembaga',
                                name: 'nama_lembaga'
                            },
                            {
                                data: 'nama_ketua',
                                name: 'nama_ketua'
                            },
                            {
                                data: 'nik_ter',
                                name: 'nik_ter'
                            },
                            {
                                data: 'nama_ter',
                                name: 'nama_ter'
                            },
                            {
                                data: 'alamat',
                                name: 'alamat'
                            },
                            {
                                data: 'status_alur',
                                name: 'status_alur'
                            },
                            {
                                data: 'tujuan',
                                name: 'tujuan'
                            },
                            {
                                data: null,
                                className: "dt-center editor-delete",
                                orderable: false,
                                "mRender": function(data, type, row) {
                                    return '<div class="btn-group" role="group" aria-label="Actions">' +
                                        '<a class="btn btn-success btn-sm" href="/rekomendasi_terdaftar_yayasans/' +
                                        data.id + '"><i class="fas fa-eye"></i>   Details </a>' +
                                        '</div>' +
                                        '<div class="btn-group" role="group" aria-label="Actions">' +
                                        '<a class="btn btn-primary btn-sm" href="/rekomendasi_terdaftar_yayasans/' +
                                        data.id + '/edit""><i class="far fa-edit"></i></i>   Proses </a>' +
                                        '</div>' +
                                        '<div class="btn-group" role="group" aria-label="Actions">' +
                                        '<a class="btn btn-info btn-sm" href="/pdfyayasan/' + data.id +
                                        '"><i class="fas fa-print"></i>   Cetak Pendaftaran </a>' +
                                        '</div>';
                                }
                            }
                        ],

                    });
                    $('#teruskan').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: {
                            url: '/teruskan-rekomendasi-terdaftar-yayasan',
                            type: 'GET',
                            dataSrc: 'data.data'
                        },
                        // ajax: "{{ route('getdata') }}",
                        columns: [{
                                data: 'no_pendaftaran',
                                name: 'no_pendaftaran'
                            },
                            {
                                data: 'nama_lembaga',
                                name: 'nama_lembaga'
                            },
                            {
                                data: 'nama_ketua',
                                name: 'nama_ketua'
                            },
                            {
                                data: 'nik_ter',
                                name: 'nik_ter'
                            },
                            {
                                data: 'nama_ter',
                                name: 'nama_ter'
                            },
                            {
                                data: 'alamat',
                                name: 'alamat'
                            },
                            {
                                data: 'status_alur',
                                name: 'status_alur'
                            },
                            {
                                data: 'tujuan',
                                name: 'tujuan'
                            },
                            {
                                data: null,
                                className: "dt-center editor-delete",
                                orderable: false,
                                "mRender": function(data, type, row) {
                                    return '<div class="btn-group" role="group" aria-label="Actions">' +
                                        '<a class="btn btn-success btn-sm" href="/rekomendasi_terdaftar_yayasans/' +
                                        data.id + '"><i class="fas fa-eye"></i>   Details </a>' +
                                        '</div>' +
                                        '<div class="btn-group" role="group" aria-label="Actions">' +
                                        '<a class="btn btn-info btn-sm" href="/pdfyayasan/' + data.id +
                                        '"><i class="fas fa-print"></i>   Cetak Pendaftaran </a>' +
                                        '</div>';
                                }
                            }
                        ],
                    });
                    $('#selesai').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: {
                            url: '/selesai-rekomendasi-terdaftar-yayasan',
                            type: 'GET',
                            dataSrc: 'data.data'
                        },
                        // ajax: "{{ route('getdata') }}",
                        columns: [{
                                data: 'no_pendaftaran',
                                name: 'no_pendaftaran'
                            },
                            {
                                data: 'nama_lembaga',
                                name: 'nama_lembaga'
                            },
                            {
                                data: 'nama_ketua',
                                name: 'nama_ketua'
                            },
                            {
                                data: 'nik_ter',
                                name: 'nik_ter'
                            },
                            {
                                data: 'nama_ter',
                                name: 'nama_ter'
                            },
                            {
                                data: 'alamat',
                                name: 'alamat'
                            },
                            {
                                data: 'status_alur',
                                name: 'status_alur'
                            },
                            {
                                data: 'tujuan',
                                name: 'tujuan'
                            },
                            {
                                data: null,
                                className: "dt-center editor-delete",
                                orderable: false,
                                "mRender": function(data, type, row) {
                                    return '<div class="btn-group" role="group" aria-label="Actions">' +
                                        '<a class="btn btn-success btn-sm" href="/rekomendasi_terdaftar_yayasans/' +
                                        data.id + '"><i class="fas fa-eye"></i>   Details </a>' +
                                        '</div>' +
                                        '<div class="btn-group" role="group" aria-label="Actions">' +
                                        '<a class="btn btn-primary btn-sm" href="/rekomendasi_terdaftar_yayasans/' +
                                        data.id + '/edit""><i class="far fa-edit"></i></i>   Proses </a>' +
                                        '</div>' +
                                        '<div class="btn-group" role="group" aria-label="Actions">' +
                                        '<a class="btn btn-info btn-sm" href="/pdfyayasan/' + data.id +
                                        '"><i class="fas fa-print"></i>   Cetak Pendaftaran </a>' +
                                        '</div>';
                                }
                            }
                        ],
                    });

                    // $('#prelistDtks').DataTable({
                    //   processing: true,
                    //   serverSide: true,
                    //   ajax: {
                    //       url: 'prelistDTKS',
                    //       type: 'GET'
                    //   },
                    //     // ajax: "{{ route('getdata') }}",
                    //     columns: [
                    //         { data: 'id_provinsi', name: 'id_provinsi' },
                    //         { data: 'id_kabkot', name: 'id_kabkot' },
                    //         { data: 'id_kecamatan', name: 'id_kecamatan' },
                    //         { data: 'name_village', name: 'name_village' },
                    //         { data: 'nik', name: 'nik' },
                    //         { data: 'no_kk', name: 'no_kk' },
                    //         { data: 'no_kis', name: 'no_kis' },
                    //         { data: 'nama', name: 'nama' },
                    //         { data: 'tgl_lahir', name: 'tgl_lahir' },
                    //         { data: 'alamat', name: 'alamat' },
                    //         { data: 'telp', name: 'telp' },
                    //         { data: 'email', name: 'email' },
                    //         { data : null, 
                    //           className: "dt-center editor-delete",
                    //           orderable: false,
                    //           "mRender" : function ( data, type, row ) {
                    //             return '<td><div class="input-group-append d-flex flex-column justify-content-center"><button  onclick="showModal(' + row.id + ')" class="btn btn-success btn-sm"><i class="fas fa-search"></i> View</a><a href="/pengaduans/'+data.id +'/edit" class="btn btn-primary btn-sm"><i class="far fa-edit"></i> Edit</a></div></td>';
                    //         }
                    //         }
                    //     ],
                    // });
                    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                        var target = $(e.target).attr("href"); // mendapatkan href dari tab aktif
                        $(target).find('table').DataTable().columns.adjust().responsive
                            .recalc(); // menyesuaikan ulang lebar kolom dan responsivitas tabel
                    });
                </script>
                <script>
                    function showModal(id) {
                        $.ajax({
                            url: `/detailpengaduan/${id}`,
                            type: 'GET',
                            success: function(response) {
                                const {
                                    data
                                } = response;
                                $('#myModal .modal-title').text(data.nama_ter);
                                $('#myModal #nama_provinsi').val(data.name_prov);
                                $('#myModal #name_cities').val(data.name_cities);
                                $('#myModal #name_districts').val(data.name_districts);
                                $('#myModal #name_village').val(data.name_village);
                                $('#myModal #nik').val(data.nik_ter);
                                $('#myModal #jenis_pelapor').val(data.jenis_pelapor);
                                $('input[name=jenis_pelapor][value=' + data.jenis_pelapor + ']').prop('checked', true);
                                $('#myModal #status_dtks').val(data.status_dtks);
                                $('input[name=status_dtks][value=' + data.status_dtks + ']').prop('checked', true);
                                $('#myModal #ada_nik').val(data.ada_nik);
                                $('input[name=ada_nik][value=' + data.ada_nik + ']').prop('checked', true);
                                $('#myModal #no_kk').val(data.no_kk);
                                $('#myModal #nama').val(data.nama);
                                $('#myModal #tempat_lahir').val(data.tempat_lahir);
                                $('#myModal #tgl_lahir').val(data.tgl_lahir);
                                $('#myModal #telp').val(data.telp);
                                $('#myModal #email').val(data.email);
                                $('#myModal #hubungan_nama_ter').val(data.hubungan_terlapor);
                                $('#myModal #id_program_sosial').val(data.id_program_sosial);
                                $('#myModal #no_peserta').val(data.no_peserta);
                                $('#myModal #kepesertaan_program').val(data.kepesertaan_program);
                                $('#myModal #kategori_pengaduan').val(data.kategori_pengaduan);
                                $('input[name=kategori_pengaduan][value=' + data.kategori_pengaduan + ']').prop('checked',
                                    true);
                                $('#myModal #level_program').val(data.level_program);
                                $('#myModal #sektor_program').val(data.sektor_program);
                                $('#myModal #no_kartu_program').val(data.no_kartu_program);
                                $('#myModal #detail_pengaduan').val(data.detail_pengaduan);
                                $('#myModal #ringkasan_pengaduan').val(data.ringkasan_pengaduan);
                                $('#myModal #petugas').val(data.petugas);
                                $('#myModal #tujuan').val(data.tujuan);
                                $('#myModal #status_aksi').val(data.status_aksi);
                                $('#myModal').modal('show');

                                const table1 = $('#log_pengaduan').DataTable({
                                    bInfo: false,
                                    searching: true,
                                    ordering: false,
                                    paging: false,
                                    processing: true,
                                    serverSide: true,
                                    ajax: {
                                        url: `/detaillogpengaduan/${id}`,
                                        type: 'GET',
                                        data: {
                                            id
                                        },
                                    },
                                    columns: [{
                                            data: 'created_at',
                                            name: 'created_at'
                                        },
                                        {
                                            data: 'name',
                                            name: 'name'
                                        },
                                        {
                                            data: 'status_aksi',
                                            name: 'status_aksi'
                                        },
                                        {
                                            data: 'tl_catatan',
                                            name: 'tl_catatan'
                                        },
                                        {
                                            data: 'tl_file',
                                            name: 'tl_file'
                                        }
                                    ]
                                });
                                if (table1) {
                                    table1.destroy();
                                }
                            }
                        });
                    }
                </script>

            @endsection
