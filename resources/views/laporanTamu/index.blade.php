@extends('layouts.masterTemplate')

@section('content')
<div class="container">
  <div class="card text-center">
    <div class="card-header">
      Data Tabel Tamu UPTD laboratorium Bahan Kontruksi 
    </div>
    <div class="card-body">
      <table id="datablepemakaian" class="table table-striped">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Nama Tamu</th>
            <th scope="col">Pegawai</th>
            <th scope="col">Kantor/Instansi</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($laporan_tamu as $item )
            <tr>
                <th scope="row">{{$loop->iteration}}</th>
                <td>{{ $item->nama_tamu }}</td>
                <td>{{ $item->pegawai }}</td>
                <td>{{ $item->kantor_instansi}}</td>
                <td><!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit{{ $item->id }}">
                      Edit
                    </button>
                    
                    <!-- Modal edit laporan tamu -->
                    <div class="modal fade" id="edit{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <form class="row g-3" method="POST" action="{{ route('laporanTamu.update',[$item->id]) }}">
                              @csrf  
                                @method('PUT')
                                  <div class="col-md-6">
                                    <label for="inputEmail4" class="form-label">Nama Tamu</label>
                                    <input type="text" name="nama_tamu" value ="{{ $item->nama_tamu }}" class="form-control" id="inputEmail4">
                                  </div>
                                  <div class="col-md-6">
                                    <label for="inputPassword4" class="form-label">Telepon</label>
                                    <input type="number" name="telepon" value ="{{ $item->telepon }}" class="form-control" id="inputPassword4">
                                  </div>
                                  <div class="col-12">
                                    <label for="kantor_instansi" class="form-label">Kantor Instansi</label>
                                    <input type="text" name="kantor_instansi" value ="{{ $item->kantor_instansi }}" class="form-control" id="inputAddress" placeholder="PT INDUSTRI INDONESIA">
                                  </div>
                                  <div class="col-md-4">
                                    <label for="inputAddress2" class="form-label">keperluan</label>
                                    <input type="text" name="bidang" value ="{{ $item->bidang }}" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
                                  </div>   
                                  <div class="col-md-4">
                                    <label for="inputCity" class="form-label">Keperluan</label>
                                    <textarea class="form-control" value ="{{ $item->keperluan }}" name="keperluan" id="textAreaExample" rows="1">{{ $item->keperluan }}</textarea>
                                  </div>
                                  <div class="col-md-4">
                                    <label for="inputAddress2" class="form-label">Pegawai</label>
                                    <input type="text" name="pegawai" value ="{{ $item->pegawai }}" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
                                  </div>                                  
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                          </div>
                        </form>
                        </div>
                      </div>
                    </div>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#hapus{{ $item->id }}">
                        Hapus
                      </button>
                      
                      <!-- Modal edit laporan tamu -->
                      <div class="modal fade" id="hapus{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Modal Hapus</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <form action="{{ route('tamu.destroy',[$item->id]) }}" method="post">
                                @csrf
                                  {{-- @method('DELETE') --}}
                                  {{-- {{ $item->nama_tamu }} --}}
                                  <h4>Apakah ada yakin untuk menghapus data tamu ini ?</h4>
                                  <button type="submit" class="btn btn-danger">Hapus Tamu</button>
                              </form>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                            </div>
                          </div>
                        </div>
                      </div>
                </td>
            </tr>
            @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

@endsection