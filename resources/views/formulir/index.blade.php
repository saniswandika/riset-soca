@extends('layouts.app')

@section('content')
<link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<style>
    /* Color of the links BEFORE scroll */
    .navbar-scroll .nav-link,
    .navbar-scroll .navbar-toggler-icon,
    .navbar-scroll .navbar-brand {
    color: #fff;
    }

    /* Color of the links AFTER scroll */
    .navbar-scrolled .nav-link,
    .navbar-scrolled .navbar-toggler-icon,
    .navbar-scrolled .navbar-brand {
    color: #fff;
    }

    /* Color of the navbar AFTER scroll */
    .navbar-scroll,
    .navbar-scrolled {
    background-color: #cbbcb1;
    }

    .mask-custom {
    backdrop-filter: blur(5px);
    background-color: rgba(255, 255, 255, .15);
    }

    .navbar-brand {
    font-size: 1.75rem;
    letter-spacing: 3px;
    }
</style>
<!-- Section: Design Block --> 

<nav class="navbar navbar-expand-lg navbar-light fixed-top mask-custom shadow-0 rounded-8" style="margin-left: 600px;width: 389px;margin-top: 11px;">
    <div class="container">
        <div class="col-12 d-flex justify-content-center">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav align-items-center mx-auto">
                    <li class="nav-item">
                        <a class="nav-link mx-2" href="/"><i class="fas fa-home fa-lg pe-2"></i>Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mx-2" href="/formulir"><i class="fas fa-atlas fa-lg pe-2"></i>formulir</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mx-2" href="/tableTamu"><i class="fas fa-atlas fa-lg pe-2"></i>Daftar Tamu</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
   
<section class="text-center">
    <!-- Background image -->
    <div class="p-5 bg-image" style="
           background-image: url('../assets/img/lab.jpg');
          height: 300px;
          "></div>
    <!-- Background image -->
    <div class="card mx-4 mx-md-5 shadow-5-strong" style="
          margin-top: -100px;
          background: hsla(0, 0%, 100%, 0.8);
          backdrop-filter: blur(30px);
          ">
            <div class="card-body py-5 px-md-5">
              @if ($errors->any())
              <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
          @endif
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-12">
                                <div class="card text-center">
                                    <div class="card-header fw-bold" style="background:rgb(255, 255, 255);">
                                      Form Input Tamu
                                    </div>
                                    <div class="card-body">
                                      <form class="row g-3" method="POST" action="{{ route('FormTamu.store') }}">
                                        @csrf
                                            <div class="col-md-6">
                                              <label for="inputEmail4" class="form-label">Nama Tamu</label>
                                              <input type="text" name="nama_tamu" class="form-control" id="inputEmail4" placeholder="Masukan Nama Anda">
                                            </div>
                                            <div class="col-md-6">
                                              <label for="inputPassword4" class="form-label">Telepon</label>
                                              <input type="number" name="telepon" class="form-control" id="inputPassword4" placeholder="Masukan No.Telepon Anda">
                                            </div>
                                            <div class="col-12">
                                              <label for="kantor_instansi" class="form-label">Kantor Instansi</label>
                                              <input type="text" name="kantor_instansi" class="form-control" id="inputAddress" placeholder="PT INDUSTRI INDONESIA">
                                            </div>
                                            <div class="col-md-4">
                                              <label for="inputState" class="form-label">Bidang</label>
                                              <input type="text" name="bidang" class="form-control" id="inputAddress2" placeholder="Masukan Bidang/Jabatan anda ?">
                                            </div>   
                                            <div class="col-md-4">
                                              <label for="inputCity" class="form-label">Keperluan</label>
                                              <select id="inputState" name="keperluan" class="form-select">
                                                <option selected>Choose...</option>
                                                <option>pengujian</option>
                                                <option>Tamu Umum</option>
                                                <option>Keperluan Lainnya</option>
                                              </select>
                                              {{-- <textarea class="form-control" name="keperluan" id="textAreaExample" rows="1"></textarea> --}}
                                            </div>
                                            <div class="col-md-4">
                                              <label for="inputAddress2" class="form-label">Tujuan</label>
                                              <input type="text" name="pegawai" class="form-control" id="inputAddress2" placeholder="Masukan Tujuan anda">
                                            </div>     
                                            <div class="col-md-4">
                                              <label for="inputAddress2" class="form-label" hidden>Tujuan</label>
                                              <input type="text" name="penilaian_tamu" value="-" class="form-control" id="inputAddress2" placeholder="Masukan Tujuan anda" hidden>
                                            </div> 
                                            <div class="d-grid gap-2">
                                                <button class="btn btn-primary" type="submit">Simpan Data Tamu</button>
                                              </div>
                                          </form>
                                    </div>
                                    <div class="card-footer text-muted">
                                        DINAS BINAMARGA PROVINSI JAWA BARAT
                                    </div>
                                  </div>
                            </div>
                        </div>
                       
                        {{-- <h2 class="fw-bold mb-5">Login To Dashboard</h2>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <!-- Email input -->
                            <div class="form-outline mb-4">
                                <input type="email" name="email" id="form3Example3" class="form-control" />
                                <label class="form-label" for="form3Example3">Email address</label>
                            </div>
                
                            <!-- Password input -->
                            <div class="form-outline mb-4">
                                <input type="password" name="password" required autocomplete="current-password" id="form3Example4" class="form-control" />
                                <label class="form-label" for="form3Example4">Password</label>
                            </div>
                
                            <!-- Submit button -->
                            <button type="submit" class="btn btn-primary btn-block mb-4">
                                Sign up
                            </button>
                        </form> --}}
                    </div>
                </div>
            </div>
    </div>
  </section>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
        $('#tamuform').DataTable();
    });
</script>
@endsection

