@extends('layouts.masterTemplate')
@section('content')

{{-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.css"/> --}}
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap5.css"/>

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
        <h6>Table Pengaduan</h6>
      </div>
      {{-- <div class="card-body px-0 pt-0 pb-2">
        <div class="table-responsive p-0">
          <table class="table align-items-center mb-0">
            <thead>
              <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Author</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Function</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Employed</th>
                <th class="text-secondary opacity-7"></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  <div class="d-flex px-2 py-1">
                    <div>
                      <img src="../assets/img/team-2.jpg" class="avatar avatar-sm me-3" alt="user1">
                    </div>
                    <div class="d-flex flex-column justify-content-center">
                      <h6 class="mb-0 text-sm">John Michael</h6>
                      <p class="text-xs text-secondary mb-0">john@creative-tim.com</p>
                    </div>
                  </div>
                </td>
                <td>
                  <p class="text-xs font-weight-bold mb-0">Manager</p>
                  <p class="text-xs text-secondary mb-0">Organization</p>
                </td>
                <td class="align-middle text-center text-sm">
                  <span class="badge badge-sm bg-gradient-success">Online</span>
                </td>
                <td class="align-middle text-center">
                  <span class="text-secondary text-xs font-weight-bold">23/04/18</span>
                </td>
                <td class="align-middle">
                  <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                    Edit
                  </a>
                </td>
              </tr>
              <tr>
                <td>
                  <div class="d-flex px-2 py-1">
                    <div>
                      <img src="../assets/img/team-3.jpg" class="avatar avatar-sm me-3" alt="user2">
                    </div>
                    <div class="d-flex flex-column justify-content-center">
                      <h6 class="mb-0 text-sm">Alexa Liras</h6>
                      <p class="text-xs text-secondary mb-0">alexa@creative-tim.com</p>
                    </div>
                  </div>
                </td>
                <td>
                  <p class="text-xs font-weight-bold mb-0">Programator</p>
                  <p class="text-xs text-secondary mb-0">Developer</p>
                </td>
                <td class="align-middle text-center text-sm">
                  <span class="badge badge-sm bg-gradient-secondary">Offline</span>
                </td>
                <td class="align-middle text-center">
                  <span class="text-secondary text-xs font-weight-bold">11/01/19</span>
                </td>
                <td class="align-middle">
                  <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                    Edit
                  </a>
                </td>
              </tr>
              <tr>
                <td>
                  <div class="d-flex px-2 py-1">
                    <div>
                      <img src="../assets/img/team-4.jpg" class="avatar avatar-sm me-3" alt="user3">
                    </div>
                    <div class="d-flex flex-column justify-content-center">
                      <h6 class="mb-0 text-sm">Laurent Perrier</h6>
                      <p class="text-xs text-secondary mb-0">laurent@creative-tim.com</p>
                    </div>
                </div>
                
      </div>
  </div> --}}

    <div class="card">
      <div class="card-body">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item">
                <a class="nav-link" id="tab1" data-toggle="tab" href="#table1" role="tab" aria-controls="table1" aria-selected="true" >Draft</a>
              </li>
          <li class="nav-item">
            <a class="nav-link" id="tab2" data-toggle="tab" href="#table2" role="tab" aria-controls="table2" aria-selected="false">Diproses</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="tab4" data-toggle="tab" href="#table4" role="tab" aria-controls="table4" aria-selected="false">Dikembalikan</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="tab3" data-toggle="tab" href="#table3" role="tab" aria-controls="table3" aria-selected="false">Selesai</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="tab5" data-toggle="tab" href="#table5" role="tab" aria-controls="table5" aria-selected="false">Prelist DTKS</a>
          </li>
          <li class="nav-item ml-auto" style="margin-left: auto">
            <a href="/pengaduans/create" class="btn btn-primary ml-2">Tambah Data</a>
          </li>
        </ul>
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show table-responsive" id="table1" role="tabpanel" aria-labelledby="tab1" style="margin-top: 20px;">
            <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                <thead>
                  <tr>
                    <th>No Pendaftaran</th>
                    <th>Tgl Pendaftaran</th>
                    <th>Layanan</th>
                    <th>Faskesos</th>
                    <th>Terlapor</th>
                    <th>NIK Terlapor</th>
                    <th>No. KK Terlapor</th>
                    <th>Sektor Program</th>
                    <th>Program</th>
                    <th>Catatan</th>
                    {{-- <th>Status</th>
                    <th>Durasi (hari)</th> --}}
                    <th>Aksi</th>
                  </tr>
                </thead>
              <tbody>
              </tbody>
            </table>
          </div>
          <div class="tab-pane fade table-responsive" id="table2" role="tabpanel" aria-labelledby="tab2" style="margin-top: 20px;">
                <table id="mytable2" class="table table-striped dt-responsive table-bordered nowrap" style="width:100%">
                  <thead>
                    <tr>
                        <th>No Pendaftaran</th>
                        <th>Tgl Pendaftaran</th>
                        <th>Layanan</th>
                        <th>Faskesos</th>
                        <th>Terlapor</th>
                        <th>NIK Terlapor</th>
                        <th>No. KK Terlapor</th>
                        <th>Sektor Program</th>
                        <th>Program</th>
                        <th>Catatan</th>
                        {{-- <th>Status</th>
                        <th>Durasi (hari)</th> --}}
                        <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    {{-- di isi di ajax --}}
                  </tbody>
              </table>
          </div>
            <div class="tab-pane fade table-responsive" id="table3" role="tabpanel" aria-labelledby="tab3" style="margin-top: 20px;">
                <table id="selesai" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                  <thead>
                    <tr>
                        <th>No Pendaftaran</th>
                        <th>Tgl Pendaftaran</th>
                        <th>Layanan</th>
                        <th>Faskesos</th>
                        <th>Terlapor</th>
                        <th>NIK Terlapor</th>
                        <th>No. KK Terlapor</th>
                        <th>Sektor Program</th>
                        <th>Program</th>
                        <th>Catatan</th>
                        {{-- <th>Status</th>
                        <th>Durasi (hari)</th> --}}
                        <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    {{-- di isi di ajax --}}
                  </tbody>
              </table>
          </div>
           <div class="tab-pane fade table-responsive" id="table4" role="tabpanel" aria-labelledby="tab4" style="margin-top: 20px;">
                <table id="dikembalikan" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                  <thead>
                    <tr>
                        <th>No Pendaftaran</th>
                        <th>Tgl Pendaftaran</th>
                        <th>Layanan</th>
                        <th>Faskesos</th>
                        <th>Terlapor</th>
                        <th>NIK Terlapor</th>
                        <th>No. KK Terlapor</th>
                        <th>Sektor Program</th>
                        <th>Program</th>
                        <th>Catatan</th>
                        {{-- <th>Status</th>
                        <th>Durasi (hari)</th> --}}
                        <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    {{-- di isi di ajax --}}
                  </tbody>
              </table>
          </div>
          <div class="tab-pane fade table-responsive" id="table5" role="tabpanel" aria-labelledby="tab4" style="margin-top: 20px;">
            <table id="prelistDtks" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
              <thead>
                <tr>
                  <th>No Pendaftaran</th>
                    <th>Tgl Pendaftaran</th>
                    <th>Layanan</th>
                    <th>Faskesos</th>
                    <th>Terlapor</th>
                    <th>NIK Terlapor</th>
                    <th>No. KK Terlapor</th>
                    <th>Sektor Program</th>
                    <th>Program</th>
                    <th>Catatan</th>
                    {{-- <th>Status</th>
                    <th>Durasi (hari)</th> --}}
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
  
  
  
{{-- <script>
    $('.selesai').DataTable({
        responsive: true,
    });
</script> --}}
<script>

    $(document).ready(function () {
            $('#datatable').DataTable({
              processing: true,
              serverSide: true,
              ajax: {
                  url: '/getdata',
                  type: 'GET'
              },
              buttons: [
                        {
                            text: 'My button',
                            action: function ( e, dt, node, config ) {
                                alert( 'Button activated' );
                            }
                        }
                    ],
                // ajax: "{{ route('getdata') }}",
                columns: [
                    { data: 'no_pendaftaran', name: 'no_pendaftaran' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'jenis_pelapor', name: 'jenis_pelapor' },
                    { data: 'id_kelurahan', name: 'id_kelurahan' },
                    { data: 'nama', name: 'nama' },
                    { data: 'nik', name: 'nik' },
                    { data: 'no_kk', name: 'no_kk' },
                    { data: 'keluhan_id_program', name: 'keluhan_id_program' },
                    { data: 'keluhan_detail', name: 'keluhan_detail' },
                    { data: 'tl_catatan', name: 'tl_catatan' },
                    { data : null, 
                      className: "dt-center editor-delete",
                      orderable: false,
                      "mRender" : function ( data, type, row ) {
                        return '<div class="input-group-append"><a href="/pengaduans/'+data.id +'/edit" class="btn btn-secondary btn-sm">Edit</a><a href="/pengaduans/'+data.id +'/delete" class="btn btn-danger btn-sm">Delete</a></div>';
                    }
                    }
                ],
            });
      });
      $('#mytable2').DataTable({
              processing: true,
              serverSide: true,
              ajax: {
                  url: '/diproses',
                  type: 'GET',
                  dataSrc: 'data.data'
              },
                columns: [
                    { data: 'no_pendaftaran', name: 'no_pendaftaran' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'jenis_pelapor', name: 'jenis_pelapor' },
                    { data: 'name_village', name: 'name_village' },
                    { data: 'nama', name: 'nama' },
                    { data: 'nik', name: 'nik' },
                    { data: 'no_kk', name: 'no_kk' },
                    { data: 'keluhan_id_program', name: 'keluhan_id_program' },
                    { data: 'keluhan_detail', name: 'keluhan_detail' },
                    { data: 'tl_catatan', name: 'tl_catatan' },
                    { data : null, 
                      className: "dt-center editor-delete",
                      orderable: false,
                      "mRender" : function ( data, type, row ) {
                        return '<td><a href="/pengaduans/'+data.id +'/edit" class="btn btn-secondary btn-sm">Edit</a><a href="/pengaduans/'+data.id +'/delete" class="btn btn-danger btn-sm">Delete</a></td>';
                    }
                    }
                ],
                
            });
            $('#dikembalikan').DataTable({
              processing: true,
              serverSide: true,
              ajax: {
                  url: '/dikembalikan',
                  type: 'GET'
              },
                // ajax: "{{ route('getdata') }}",
                columns: [
                    { data: 'no_pendaftaran', name: 'no_pendaftaran' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'jenis_pelapor', name: 'jenis_pelapor' },
                    { data: 'id_kelurahan', name: 'id_kelurahan' },
                    { data: 'nama', name: 'nama' },
                    { data: 'nik', name: 'nik' },
                    { data: 'no_kk', name: 'no_kk' },
                    { data: 'keluhan_id_program', name: 'keluhan_id_program' },
                    { data: 'keluhan_detail', name: 'keluhan_detail' },
                    { data: 'tl_catatan', name: 'tl_catatan' },
                    { data : null, 
                      className: "dt-center editor-delete",
                      orderable: false,
                      "mRender" : function ( data, type, row ) {
                        return '<td><a href="/pengaduans/'+data.id +'/edit" class="btn btn-secondary btn-sm">Edit</a><a href="/pengaduans/'+data.id +'/delete" class="btn btn-danger btn-sm">Delete</a></td>';
                    }
                    }
                ],
            });
            $('#selesai').DataTable({
              processing: true,
              serverSide: true,
              ajax: {
                  url: '/selesai',
                  type: 'GET'
              },
                // ajax: "{{ route('getdata') }}",
                columns: [
                    { data: 'no_pendaftaran', name: 'no_pendaftaran' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'jenis_pelapor', name: 'jenis_pelapor' },
                    { data: 'id_kelurahan', name: 'id_kelurahan' },
                    { data: 'nama', name: 'nama' },
                    { data: 'nik', name: 'nik' },
                    { data: 'no_kk', name: 'no_kk' },
                    { data: 'keluhan_id_program', name: 'keluhan_id_program' },
                    { data: 'keluhan_detail', name: 'keluhan_detail' },
                    { data: 'tl_catatan', name: 'tl_catatan' },
                    { data : null, 
                      className: "dt-center editor-delete",
                      orderable: false,
                      "mRender" : function ( data, type, row ) {
                        return '<td><a href="/pengaduans/'+data.id +'/edit" class="btn btn-secondary btn-sm">Edit</a><a href="/pengaduans/'+data.id +'/delete" class="btn btn-danger btn-sm">Delete</a></td>';
                    }
                    }
                ],
            });
            $('#prelistDtks').DataTable({
              processing: true,
              serverSide: true,
              ajax: {
                  url: 'prelistDTKS',
                  type: 'GET'
              },
                // ajax: "{{ route('getdata') }}",
                columns: [
                    { data: 'no_pendaftaran', name: 'no_pendaftaran' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'jenis_pelapor', name: 'jenis_pelapor' },
                    { data: 'id_kelurahan', name: 'id_kelurahan' },
                    { data: 'nama', name: 'nama' },
                    { data: 'nik', name: 'nik' },
                    { data: 'no_kk', name: 'no_kk' },
                    { data: 'keluhan_id_program', name: 'keluhan_id_program' },
                    { data: 'keluhan_detail', name: 'keluhan_detail' },
                    { data: 'tl_catatan', name: 'tl_catatan' },
                    { data : null, 
                      className: "dt-center editor-delete",
                      orderable: false,
                      "mRender" : function ( data, type, row ) {
                        return '<td><a href="/pengaduans/'+data.id +'/edit" class="btn btn-secondary btn-sm">Edit</a><a href="/pengaduans/'+data.id +'/delete" class="btn btn-danger btn-sm">Delete</a></td>';
                    }
                    }
                ],
            });
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        var target = $(e.target).attr("href"); // mendapatkan href dari tab aktif
        $(target).find('table').DataTable().columns.adjust().responsive.recalc(); // menyesuaikan ulang lebar kolom dan responsivitas tabel
    });
</script>
@endsection
