@extends('layouts.masterTemplate')
@section('content')
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.css"/>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.css"/>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap5.css"/>
 
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/js/bootstrap.bundle.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.5/js/dataTables.buttons.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap5.js"></script>
  {{-- <div class="container">
    <div class="card">
        <div class="card-body">
            <div class="container p-5">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                      <a data-toggle="tab" class="nav-link active" href="#draft"><icon class="fa fa-home"></icon> Table 1</a>
                    </li>
                    <li class="nav-item">
                      <a data-toggle="tab" class="nav-link" href="#Diproses"><i class="fa fa-user"></i> Diproses</a>
                    </li>
                    <li class="nav-item">
                      <a data-toggle="tab" class="nav-link" href="#Selesai"><i class="fa fa-user"></i> Selesai </a>
                    </li>
                        <div class="col-sm-6" style="margin-left: 240px;">
                            <a class="btn btn-primary float-right mb-2"
                               href="{{ route('rubahwilayah') }}">
                                Add New
                            </a>
                        </div>
                  </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane active py-3" id="draft">
                            <table class="display table-responsive" cellspacing="0" width="100%">
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
                                            <th>Status</th>
                                            <th>Durasi (hari)</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Tiger Nixon</td>
                                            <td>2011/04/25</td>
                                            <td>2011/04/25</td>
                                            <td>System Architect</td>
                                            <td>Edinburgh</td>
                                            <td>61</td>
                                            <td>2011/04/25</td>
                                            <td>$320,800</td>
                                            <td>$320,800</td>
                                            <td>$320,800</td>
                                            <td>$320,800</td>
                                            <td>$320,800</td>
                                            <td>61</td>
                                        </tr>
                                    </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade py-3" id="Diproses">
                             <h2>TABLE - Diproses</h2>
                            <table class="table-responsive" id="myTable2" cellspacing="0" width="100%">
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
                                        <th>Status</th>
                                        <th>Durasi (hari)</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Tiger Nixon</td>
                                        <td>2011/04/25</td>
                                        <td>2011/04/25</td>
                                        <td>System Architect</td>
                                        <td>Edinburgh</td>
                                        <td>61</td>
                                        <td>2011/04/25</td>
                                        <td>$320,800</td>
                                        <td>$320,800</td>
                                        <td>$320,800</td>
                                        <td>$320,800</td>
                                        <td>$320,800</td>
                                        <td>61</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane py-3" id="Selesai">
                             <h2>TABLE - Selesai </h2>
                                <table class="table table-striped table-bordered display" cellspacing="0" width="100%">
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
                                            <th>Status</th>
                                            <th>Durasi (hari)</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Tiger Nixon</td>
                                            <td>2011/04/25</td>
                                            <td>2011/04/25</td>
                                            <td>System Architect</td>
                                            <td>Edinburgh</td>
                                            <td>61</td>
                                            <td>2011/04/25</td>
                                            <td>$320,800</td>
                                            <td>$320,800</td>
                                            <td>$320,800</td>
                                            <td>$320,800</td>
                                            <td>$320,800</td>
                                            <td>61</td>
                                        </tr>
                                    </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
      </div>
  </div> --}}

    <div class="card">
      <div class="card-body">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="tab1" data-toggle="tab" href="#table1" role="tab" aria-controls="table1" aria-selected="true">Draft</a>
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
          <li class="nav-item ml-auto">
            <a href="/pengaduans/create" class="btn btn-primary ml-2">Tambah Data</a>
          </li>
        </ul>
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active table-responsive" id="table1" role="tabpanel" aria-labelledby="tab1">
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
                    {{-- // <th>Status</th>
                    // <th>Durasi (hari)</th>
                    // <th>Aksi</th> --}}
                  </tr>
                </thead>
              <tbody></tbody>
            </table>
          </div>
          <div class="tab-pane fade table-responsive" id="table2" role="tabpanel" aria-labelledby="tab2">
                <table id="mytable2" class="table table-striped table-bordered  nowrap" style="width:100%">
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
                      {{-- // <th>Status</th>
                      // <th>Durasi (hari)</th>
                      // <th>Aksi</th> --}}
                    </tr>
                  </thead>
                  <tbody>
                    {{-- di isi di ajax --}}
                  </tbody>
              </table>
          </div>
            <div class="tab-pane fade table-responsive" id="table3" role="tabpanel" aria-labelledby="tab3">
                <table id="selesai" class="table table-striped table-bordered  nowrap" style="width:100%">
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
                      {{-- // <th>Status</th>
                      // <th>Durasi (hari)</th>
                      // <th>Aksi</th> --}}
                    </tr>
                  </thead>
                  <tbody>
                    {{-- di isi di ajax --}}
                  </tbody>
              </table>
          </div>
           <div class="tab-pane fade table-responsive" id="table4" role="tabpanel" aria-labelledby="tab3">
                <table id="dikembalikan" class="table table-striped table-bordered  nowrap" style="width:100%">
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
                      {{-- // <th>Status</th>
                      // <th>Durasi (hari)</th>
                      // <th>Aksi</th> --}}
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
                    { data: 'tl_catatan', name: 'tl_catatan' }
                ],
            });
      });
     
      $('#mytable2').DataTable({
              processing: true,
              serverSide: true,
              ajax: {
                  url: '/diproses',
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
                    { data: 'tl_catatan', name: 'tl_catatan' }
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
                    { data: 'tl_catatan', name: 'tl_catatan' }
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
                    { data: 'tl_catatan', name: 'tl_catatan' }
                ],
            });
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        var target = $(e.target).attr("href"); // mendapatkan href dari tab aktif
        $(target).find('table').DataTable().columns.adjust().responsive.recalc(); // menyesuaikan ulang lebar kolom dan responsivitas tabel
    });
</script>
@endsection
