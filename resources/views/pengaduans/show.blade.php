@extends('layouts.masterTemplate')

@section('title', 'Detail Pengaduan')

@section('content')

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
<?php
    use Carbon\Carbon;
    
    $birthdatestring = $pengaduan->tgl_lahir;
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
                    <div class="card-header col-sm-6">
                        <h3>Detail Pengaduan</h3>
                      </div>
                      <div class="card-header col-sm-6">
                        <a class="btn btn-primary" style="float: right"
                           href="{{ route('pengaduans.index') }}">
                                                        @lang('Kembali')
                                                </a>
                    </div>
                    <div class="card-body">
                    @include('pengaduans.show_fields')
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
                          </tbody>
                        </table>
                        <br>
                        <a class="btn btn-primary" style="float: right"
                           href="{{ route('pengaduans.index') }}">
                                                        @lang('kembali')
                                                </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    $(document).ready(function () {
        var url = window.location.href;
        var id = url.substring(url.lastIndexOf('/') + 1);
        $('#datatable').DataTable({
            bInfo : false,
            searching: false,
            ordering:  false,
            paging: false,
              processing: true,
              serverSide: true,
              ajax: {
                  url: "/detailpengaduan/" + id,
                  type: 'GET',
                  "data": { "id": id },
              },
                // ajax: "{{ route('getdata') }}",
                columns: [
                    { data: 'created_at', name: 'created_at' },
                    { data: 'created_by', name: 'created_by' },
                    { data: 'id_alur', name: 'id_alur' },
                    { data: 'catatan', name: 'catatan' },
                    { data: 'file_pendukung', name: 'file_pendukung' }
                ],
            });
    });
    </script>
@endsection
