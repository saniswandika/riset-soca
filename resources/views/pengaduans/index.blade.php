@extends('layouts.masterTemplate')

@section('title', 'Menu Layanan')

@section('content')

{{-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.css"/> --}}
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap5.css"/>

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
        <h6>Table Pengaduan</h6>
      </div>
      <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title"></h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                  <button class="nav-link " id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="false">Form Pengaduan</button>
                  <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">log pengaduan</button>
                  {{-- <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Contact</button> --}}
                </div>
              </nav>
              <div class="tab-content mt-4" id="nav-tabContent">
                <div class="tab-pane fade" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Provinsi</label>
                    <div class="col-sm-8">
                        <input type="text" required class="form-control" id="nama_provinsi"  name="nama_provinsi"
                            readonly>
                        <input type="hidden" name="id_provinsi">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Kab/Kota</label>
                    <div class="col-sm-8">
                        <input type="text" required class="form-control" id="name_cities"  name="id_kabkot"
                            readonly>
                        <input type="hidden" name="id_kabkot" id="id_kabkot">

                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Kecamatan</label>
                    <div class="col-sm-8">
                        <input type="text" required class="form-control" 
                            name="name_kecamatan" id="name_districts" readonly>
                        <input type="hidden" name="id_kecamatan" >
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Kelurahan</label>
                    <div class="col-sm-8">
                        <input type="text" required class="form-control" id="name_village" name="name_kelurahan"
                            readonly>
                        <input type="hidden" name="id_kelurahan" id="id_kabkot">
                    </div>
                </div>
        
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Jenis Pelaporan <span class="text-danger">*</label>
              <div class="col-sm-8">
                  <div class="row">
                      <div class="col">
                          <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" id="inlineCheckbox1" value="1"
                                  name="jenis_pelapor" disabled>
                              <label class="form-check-label" for="inlineCheckbox1">Diri Sendiri</label>
                          </div>
                      </div>
                      <div class="col">
                          <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" id="inlineCheckbox2" value="0"
                                  name="jenis_pelapor" disabled>
                              <label class="form-check-label" for="inlineCheckbox2">Orang Lain</label>
                          </div>
                      </div>
                  </div>
      
              </div>
            </div>
          <div class="form-group row">
              <label class="col-sm-3 col-form-label">Apa Pelapor Memiliki NIK <span class="text-danger">*</label>
              <div class="col-sm-8">
                  <div class="row">
                      <div class="col">
                          <div class="form-check form-check-inline">
                              <input type="radio" class="form-check-input" name="ada_nik" value="1"  disabled>
                              <label class="form-check-label" for="inlineCheckbox1">Ya</label>
                          </div>
                      </div>
                      <div class="col">
                          <div class="form-check form-check-inline">
                              <input type="radio" class="form-check-input" name="ada_nik" value="0" disabled>
                              <label class="form-check-label" for="inlineCheckbox2">Tidak</label>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="form-group row">
              <label class="col-sm-3 col-form-label">NIK</label>
              <div class="col-sm-8">
                  <input type="number" class="form-control" name="nik" id="nik" readonly>
              </div>
          </div>
          <div class="form-group row">
              <label class="col-sm-3 col-form-label" for="inlineCheckbox1">Status DTKS</label>
              <div class="col-sm-8">
                  <div class="row">
                      <div class="col">
                          <div class="form-check form-check-inline">
                              <input type="radio" class="form-check-input" name="status_dtks" value="1" disabled >
                              <label class="form-check-label" for="inlineCheckbox1">Terdaftar</label>
                          </div>
                      </div>
                      <div class="col">
                          <div class="form-check form-check-inline">
                              <input type="radio" class="form-check-input" name="status_dtks" value="0" disabled>
                              <label class="form-check-label" for="inlineCheckbox2">Tidak Terdaftar</label>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="form-group row">
              <label class="col-sm-3 col-form-label">No. KK</label>
              <div class="col-sm-8">
                  <input type="number" class="form-control"  name="no_kk" id="no_kk" readonly>
                  <small id="kkhelper" class="form-text text-muted">
                      Harus angka, 16 digit
                  </small>
              </div>
          </div>
          <div class="form-group row">
              <label class="col-sm-3 col-form-label">Nama <span class="text-danger">*</label>
              <div class="col-sm-8">
                  <input type="text" class="form-control" name="nama" id="nama" readonly>
              </div>
          </div>
          <div class="form-group row">
              <label class="col-sm-3 col-form-label">Tempat Lahir <span class="text-danger">*</label>
              <div class="col-sm-8">
                  <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir"
                      readonly>
              </div>
          </div>
          <div class="form-group row">
              <label class="col-sm-3 col-form-label">Tanggal Lahir <span class="text-danger">*</label>
              <div class="col-sm-8">
                  <input type="text" class="form-control" name="tgl_lahir" id="tgl_lahir"
                      readonly>
              </div>
          </div>
          <div class="form-group row">
              <label class="col-sm-3 col-form-label">Telpon <span class="text-danger">*</label>
              <div class="col-sm-8">
                  <input type="tel" class="form-control" name="telp" id="telp" readonly>
                  <small id="nikhelper" class="form-text text-muted">
                      Harus angka, max 13 digit
                  </small>
              </div>
          </div>
          <div class="form-group row">
              <label class="col-sm-3 col-form-label">Email</label>
              <div class="col-sm-8">
                  <input type="text" class="form-control" name="email" id="email" readonly>
              </div>
          </div>
          <div class="form-group row">
              <label class="col-sm-3 col-form-label">Hubungan dengan terlapor</label>
              <div class="col-sm-8">
                  <input type="text" class="form-control" name="hubungan_terlapor" id="hubungan_terlapor" readonly>
              </div>
          </div>
      
          {{-- kepesertaan --}}
          <div form-group row>
              <h4><b>Catatan Kepesertaan</b></h4>
          </div>
          <div class="form-group row">
              <label class="col-sm-3 col-form-label">Program</label>
              <div class="col-sm-8">
                  <input type="text" class="form-control" name="id_program_sosial" id="id_program_sosial" readonly>
              </div>
          </div>
          <div class="form-group row">
              <label class="col-sm-3 col-form-label">No Peserta</label>
              <div class="col-sm-8">
                  <input type="text" class="form-control" name="no_peserta" id="no_peserta"readonly>
              </div>
          </div>
          {{-- Pengaduan Program --}}
      
          <div form-group row>
              <h4><b>PENGADUAN PROGRAM</b></h4>
          </div>
          <div class="form-group row">
              <label class="col-sm-3 col-form-label">Program</label>
              <div class="col-sm-8">
                  <input type="text" class="form-control" name="kepesertaan_program" id="kepesertaan_program" readonly>
              </div>
          </div>
          <div class="form-group row">
              <label class="col-sm-3 col-form-label">Kategori Pengaduan <span class="text-danger">*</label>
              <div class="col-sm-8">
                  <div class="row">
                      <div class="col">
                          <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" id="inlineCheckbox2" name="kategori_pengaduan" value="1" disabled>
                              <label class="form-check-label" for="inlineCheckbox2">kepesertaan program</label>
                          </div>
                      </div>
                      <div class="col">
                          <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" id="inlineCheckbox2" name="kategori_pengaduan" value="0" disabled>
                              <label class="form-check-label" for="inlineCheckbox2">Kebutuhan program</label>
                          </div>
                      </div>
                  </div>
      
              </div>
          </div>
      
          <div class="form-group row">
              <label class="col-sm-3 col-form-label">Level Program</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" name="level_program" id="level_program" disabled>
              </div>
          </div>
      
          <div class="form-group row">
              <label class="col-sm-3 col-form-label">Sektor Program</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" name="sektor_program" id="sektor_program" disabled>
              </div>
          </div>
          <div class="form-group row">
              <label class="col-sm-3 col-form-label">No Kartu Program</label>
              <div class="col-sm-8">
                  <input type="text" class="form-control" name="no_kartu_program" id="no_kartu_program" disabled>
              </div>
          </div>
          <div class="form-group row">
              <label class="col-sm-3 col-form-label">Ringkasan Pengaduan <span class="text-danger">*</label>
              <div class="col-sm-8">
                  <input type="text" class="form-control" name="ringkasan_pengaduan" id="ringkasan_pengaduan" disabled>
              </div>
          </div>
          <div class="form-group row">
              <label class="col-sm-3 col-form-label">Detail Pengaduan <span class="text-danger">*</label>
              <div class="col-sm-8">
                  <textarea class="form-control" name="detail_pengaduan" id="detail_pengaduan" readonly></textarea>
              </div>
          </div>
          <div class="form-group row">
              <label class="col-sm-3 col-form-label">File Penunjang</label>
              <div class="col-sm-8">
                  <input type="file" name="file_penunjang">
              </div>
          </div>
          <div class="form-group row">
              <label class="col-sm-3 col-form-label">Status Alur</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" name="status_aksi" id="status_aksi" disabled>
              </div>
          </div>
          <div class="form-group row">
              <label class="col-sm-3 col-form-label">Tujuan <span class="text-danger">*</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" name="tujuan" id="tujuan" disabled>
              </div>
          </div>
          <div class="form-group row">
              <label class="col-sm-3 col-form-label">Petugas <span class="text-danger">*</label>
              <div class="col-sm-8">
                    <input type="text" class="form-control" name="petugas" id="petugas" disabled>
              </div>
          </div>       
          </div>
                </div>
                <div class="tab-pane fade table-responsive" id="nav-profile" role="tabpanel" style="margin-top: 20px;">
                  <table id="log_pengaduan" class="table table-striped dt-responsive table-bordered nowrap" style="width:100%">
                {{-- <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                    <table id="log_pengaduan" class="table table-striped table-bordered" style="width:100%"> --}}
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
                      </tbody>
                    </table>
                </div>
                {{-- <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">...</div> --}}
              </div>
                
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
            </div>
          </div>
        </div>
      </div>
    <div class="card">
      <div class="card-body">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <?php
              $userid = Auth::user()->id;
              $usersrole = DB::table('model_has_roles')->leftJoin('users', 'users.id', '=', 'model_has_roles.model_id')->leftJoin('roles', 'roles.id', '=', 'model_has_roles.role_id')->where('model_id', $userid)->get();
              // dd($usersrole);
          ?>
          @foreach ($usersrole as $item)
              @if ($item->name == 'fasilitator')
                <li class="nav-item">
                  <a class="nav-link" id="tab1" data-toggle="tab" href="#table1" role="tab" aria-controls="table1" aria-selected="true" >Draft</a>
                </li>
            @elseif ($item->name == 'Front Office Kota')
                <li class="nav-item">
                  <a class="nav-link" id="tab1" data-toggle="tab" href="#table1" role="tab" aria-controls="table1" aria-selected="true" >Draft</a>
                </li>
            @elseif ($item->name == 'Front Office Kelurahan')
              <li class="nav-item">
                <a class="nav-link" id="tab1" data-toggle="tab" href="#table1" role="tab" aria-controls="table1" aria-selected="true" >Draft</a>
              </li>
              @endif
          @endforeach
          
          <li class="nav-item">
            <a class="nav-link" id="tab2" data-toggle="tab" href="#table2" role="tab" aria-controls="table2" aria-selected="false">Diproses</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="tab4" data-toggle="tab" href="#table4" role="tab" aria-controls="table4" aria-selected="false">Teruskan</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="tab3" data-toggle="tab" href="#table3" role="tab" aria-controls="table3" aria-selected="false">Selesai</a>
          </li>
          @auth
              <li class="nav-item ml-auto" style="margin-left: auto">
                @foreach ($usersrole as $item)
                    @if ($item->name == 'fasilitator')
                      <a href="/pengaduans/create" class="btn btn-primary ml-2">Tambah Data</a>
                        @elseif ($item->name == 'Front Office Kota')
                        <a href="/pengaduans/create" class="btn btn-primary ml-2">Tambah Data</a>
                        @elseif ($item->name == 'Front Office Kelurahan')
                        <a href="/pengaduans/create" class="btn btn-primary ml-2">Tambah Data</a>
                    @endif
                @endforeach
              </li>
          @endauth
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
                <table id="teruskan" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
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
                  type: 'GET',
                  dataSrc: 'data.data'
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
                    { data: 'name_village', name: 'name_village' },
                    { data: 'nama', name: 'Terlapor' },
                    { data: 'nik', name: 'nik' },
                    { data: 'no_kk', name: 'no_kk' },
                    { data: 'kepesertaan_program', name: 'kepesertaan_program' },
                    { data: 'ringkasan_pengaduan', name: 'ringkasan_pengaduan' },
                    { data: 'tl_catatan', name: 'tl_catatan' },
                    { data : null, 
                      className: "dt-center editor-delete",
                      orderable: false,
                      "mRender" : function ( data, type, row ) {
                        return '<div class="btn-group" role="group" aria-label="Actions">' +
                                '<a onclick="showModal(' + row.id + ')" class="btn btn-success btn-sm"><i class="fas fa-eye"></i>   Details </a>' +
                                '</div>'+
                                '<div class="btn-group" role="group" aria-label="Actions">'+
                                '<a class="btn btn-primary btn-sm" href="/pengaduans/'+data.id +'/edit""><i class="far fa-edit"></i></i>   Edit </a>' +
                                '</div>';
                                
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
                    { data: 'nama', name: 'Terlapor' },
                    { data: 'nik', name: 'nik' },
                    { data: 'no_kk', name: 'no_kk' },
                    { data: 'kepesertaan_program', name: 'kepesertaan_program' },
                    { data: 'ringkasan_pengaduan', name: 'ringkasan_pengaduan' },
                    { data: 'tl_catatan', name: 'tl_catatan' },
                    { data : null, 
                      className: "dt-center editor-delete",
                      orderable: false,
                      "mRender" : function ( data, type, row ) {
                        return '<div class="btn-group" role="group" aria-label="Actions">' +
                                '<a onclick="showModal(' + row.id + ')" class="btn btn-success btn-sm"><i class="fas fa-eye"></i>   Details  </a>' +
                                '</div>'+
                                '<div class="btn-group" role="group" aria-label="Actions">'+
                                '<a class="btn btn-primary btn-sm" href="/pengaduans/'+data.id +'/edit""><i class="far fa-edit"></i></i>   Proses </a>' +
                                '</div>';
                      }
                    }
                ],
                
            });
            $('#teruskan').DataTable({
              processing: true,
              serverSide: true,
              ajax: {
                  url: '/teruskan',
                  type: 'GET',
                  dataSrc: 'data.data'
              },
                // ajax: "{{ route('getdata') }}",
                columns: [
                    { data: 'no_pendaftaran', name: 'no_pendaftaran' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'jenis_pelapor', name: 'jenis_pelapor' },
                    { data: 'name_village', name: 'name_village' },
                    { data: 'nama', name: 'nama' },
                    { data: 'nik', name: 'nik' },
                    { data: 'no_kk', name: 'no_kk' },
                    { data: 'kepesertaan_program', name: 'kepesertaan_program' },
                    { data: 'ringkasan_pengaduan', name: 'ringkasan_pengaduan' },
                    { data: 'tl_catatan', name: 'tl_catatan' },
                    { data : null, 
                      className: "dt-center editor-delete",
                      orderable: false,
                      "mRender" : function ( data, type, row ) {
                        return '<div class="btn-group" role="group" aria-label="Actions">' +
                                '<a onclick="showModal(' + row.id + ')" class="btn btn-success btn-sm"><i class="fas fa-eye"></i>   Details </a>' +
                                '</div>'+
                                '<div class="btn-group" role="group" aria-label="Actions">'+
                                '<a class="btn btn-primary btn-sm" href="/pengaduans/'+data.id +'/edit""><i class="far fa-edit"></i>   Proses </a>' +
                                '</div>'+
                                '<div class="btn-group" role="group" aria-label="Actions">'+
                                '<a class="btn btn-info btn-sm" href="/pdf/'+data.id +'"><i class="fas fa-print"></i>   Cetak Pendaftaran </a>' +
                                '</div>';
                      }
                    }
                ],
            });
            $('#selesai').DataTable({
              processing: true,
              serverSide: true,
              ajax: {
                  url: '/selesai',
                  type: 'GET',
                  dataSrc: 'data.data'
              },
                // ajax: "{{ route('getdata') }}",
                columns: [
                    { data: 'no_pendaftaran', name: 'no_pendaftaran' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'jenis_pelapor', name: 'jenis_pelapor' },
                    { data: 'name_village', name: 'name_village' },
                    { data: 'nama', name: 'nama' },
                    { data: 'nik', name: 'nik' },
                    { data: 'no_kk', name: 'no_kk' },
                    { data: 'kepesertaan_program', name: 'kepesertaan_program' },
                    { data: 'ringkasan_pengaduan', name: 'ringkasan_pengaduan' },
                    { data: 'tl_catatan', name: 'tl_catatan' },
                    { data : null, 
                      className: "dt-center editor-delete",
                      orderable: false,
                      "mRender" : function ( data, type, row ) {
                        return '<div class="btn-group" role="group" aria-label="Actions">' +
                                '<a onclick="showModal(' + row.id + ')" class="btn btn-success btn-sm"><i class="fas fa-eye"></i>   Details </a>' +
                                '</div>'+
                                // '<div class="btn-group" role="group" aria-label="Actions">'+
                                // '<a class="btn btn-primary btn-sm" href="/pengaduans/'+data.id +'/edit""><i class="far fa-edit"></i></i>   Proses </a>' +
                                // '</div>'+
                                '<div class="btn-group" role="group" aria-label="Actions">'+
                                '<a class="btn btn-info btn-sm" href="/pdf/'+data.id +'"><i class="fas fa-print"></i>   Cetak Pendaftaran </a>' +
                                '</div>';
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
                    { data: 'id_provinsi', name: 'id_provinsi' },
                    { data: 'id_kabkot', name: 'id_kabkot' },
                    { data: 'id_kecamatan', name: 'id_kecamatan' },
                    { data: 'name_village', name: 'name_village' },
                    { data: 'nik', name: 'nik' },
                    { data: 'no_kk', name: 'no_kk' },
                    { data: 'no_kis', name: 'no_kis' },
                    { data: 'nama', name: 'nama' },
                    { data: 'tgl_lahir', name: 'tgl_lahir' },
                    { data: 'alamat', name: 'alamat' },
                    { data: 'telp', name: 'telp' },
                    { data: 'email', name: 'email' },
                    { data : null, 
                      className: "dt-center editor-delete",
                      orderable: false,
                      "mRender" : function ( data, type, row ) {
                        return '<td><div class="input-group-append d-flex flex-column justify-content-center"><button  onclick="showModal(' + row.id + ')" class="btn btn-success btn-sm"><i class="fas fa-search"></i> View</a><a href="/pengaduans/'+data.id +'/edit" class="btn btn-primary btn-sm"><i class="far fa-edit"></i> Edit</a></div></td>';
                    }
                    }
                ],
            });
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        var target = $(e.target).attr("href"); // mendapatkan href dari tab aktif
        $(target).find('table').DataTable().columns.adjust().responsive.recalc(); // menyesuaikan ulang lebar kolom dan responsivitas tabel
    });
</script>
<script>
    
     function showModal(id) {
                $.ajax({
                    url: '/detailpengaduan/' + id,
                    type: 'GET',
                    // dataSrc: 'data'
                    success: function(response) {
                    //   console.log(response);
                        $('#myModal .modal-title').text(response.data.nama);
                        $('#myModal #nama_provinsi').val(response.data.name_prov);
                        $('#myModal #name_cities').val(response.data.name_cities);
                        $('#myModal #name_districts').val(response.data.name_districts);
                        $('#myModal #name_village').val(response.data.name_village);
                        $('#myModal #nik').val(response.data.nik);
                        $('#myModal #jenis_pelapor').val(response.data.jenis_pelapor);
                        if (response.data.jenis_pelapor == 1) {
                            $('input[name=jenis_pelapor][value=1]').prop('checked', true);
                        } else {
                            $('input[name=jenis_pelapor][value=0]').prop('checked', true);
                        }
                        $('#myModal #status_dtks').val(response.data.status_dtks);
                        if (response.data.status_dtks == 1) {
                            console.log(response.data.status_dtks);
                            $('input[name=status_dtks][value=1]').prop('checked', true);
                        } else {
                            $('input[name=status_dtks][value=0]').prop('checked', true);
                        }
                        $('#myModal #ada_nik').val(response.data.ada_nik);
                        if (response.data.ada_nik == 1) {
                            $('input[name=ada_nik][value=1]').prop('checked', true);
                        } else {
                            $('input[name=ada_nik][value=0]').prop('checked', true);
                        }
                        $('#myModal #no_kk').val(response.data.no_kk);
                        $('#myModal #nama').val(response.data.nama);
                        $('#myModal #tempat_lahir').val(response.data.tempat_lahir);
                        $('#myModal #tgl_lahir').val(response.data.tgl_lahir);
                        $('#myModal #telp').val(response.data.telp);
                        $('#myModal #email').val(response.data.email);
                        $('#myModal #hubungan_terlapor').val(response.data.hubungan_terlapor);
                        $('#myModal #id_program_sosial').val(response.data.id_program_sosial);
                        $('#myModal #no_peserta').val(response.data.no_peserta);
                        $('#myModal #kepesertaan_program').val(response.data.kepesertaan_program);
                        $('#myModal #kategori_pengaduan').val(response.data.kategori_pengaduan);
                        if (response.data.kategori_pengaduan == 1) {
                            $('input[name=kategori_pengaduan][value=1]').prop('checked', true);
                        } else {
                            $('input[name=kategori_pengaduan][value=0]').prop('checked', true);
                        }
                        $('#myModal #level_program').val(response.data.level_program);
                        $('#myModal #sektor_program').val(response.data.sektor_program);
                        $('#myModal #no_kartu_program').val(response.data.no_kartu_program);
                        $('#myModal #detail_pengaduan').val(response.data.detail_pengaduan);
                        $('#myModal #ringkasan_pengaduan').val(response.data.ringkasan_pengaduan);
                        $('#myModal #petugas').val(response.data.petugas);
                        $('#myModal #tujuan').val(response.data.tujuan);
                        $('#myModal #status_aksi').val(response.data.status_aksi);
                        $('#myModal').modal('show');
                     
                        table1 = $('#log_pengaduan').DataTable({
                                bInfo: false,
                                searching: true,
                                ordering: false,
                                paging: false,
                                processing: true,
                                serverSide: true,
                                ajax: {
                                url: "/detaillogpengaduan/" + id,
                                type: 'GET',
                                data: { "id": id },
                                },
                                columns: [
                                { data: 'created_at', name: 'created_at' },
                                { data: 'name', name: 'name' },
                                { data: 'status_aksi', name: 'status_aksi' },
                                { data: 'tl_catatan', name: 'tl_catatan' },
                                { data: 'tl_file', name: 'tl_file' }
                                ]
                            });
                        // $('#log_pengaduan').DataTable({
                        //   bInfo : false,
                        //   searching: false,
                        //   ordering:  false,
                        //   paging: false,
                        //     processing: true,
                        //     serverSide: true,
                        //     ajax: {
                        //         url: "/detaillogpengaduan/" + id,
                        //         type: 'GET',
                        //         data: { "id": id },
                        //     },
                        //       // ajax: "{{ route('getdata') }}",
                        //       columns: [
                        //           { data: 'created_at', name: 'created_at' },
                        //           { data: 'name', name: 'name' },
                        //           { data: 'status_aksi', name: 'status_aksi' },
                        //           { data: 'tl_catatan', name: 'tl_catatan' },
                        //           { data: 'tl_file', name: 'tl_file' }
                        //       ],
                        // });
                    }
                });
                if (table1) {
                            table1.destroy();
                        }
            }
  // $(document).ready(function () {
    
  // });
  </script>
@endsection
