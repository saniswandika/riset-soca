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
                        <a class="nav-link mx-2" href="/formulir"><i class="fas fa-atlas fa-lg pe-2"></i>Formulir</a>
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
          /* backdrop-filter: blur(30px); */
          ">
            <div class="card-body py-5 px-md-5">
        
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-12">
                        <div class="card text-center">
                            <div class="card-header">Featured</div>
                            <div class="card-body">
                                <table id="tamuform" class="table table-striped">
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
                                                <td>
                                                   <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-primary" data-mdb-toggle="modal" data-mdb-target="#edit{{$item->id }}">
                                                        Penilaian Tamu
                                                    </button>
                                                    
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="edit{{$item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-xl">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Reaction Pengunjung {{ $item->nama_tamu }}</h5>
                                                                    <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <form class="row g-3" method="POST" action="{{ route('FormTamu.edit',[$item->id]) }}">
                                                                    @csrf
                                                                    <div class="modal-body">
                                                                        {{-- <input type="text" name="penilaian_tamu" id="form12" class="form-control" />
                                                                        <label class="form-label" for="form12">Example label</label> --}}
                                                                        <div class="d-flex align-items-start bg-light mb-3" style="height: 100px;">
                                                                            <div class="col">
                                                                                <div class="card">
                                                                                    <div class="card-body">
                                                                                        <i class="far fa-laugh-squint fa-6x" style="color: #7999cd"></i>
                                                                                        <h4 class="mt-2">
                                                                                            sangat puas
                                                                                        </h4>
                                                                                    </div>
                                                                                </div>
                                                                                
                                                                                <input type="radio" class="mt-2" id="option1" name="penilaian_tamu" value="sangat puas"  style="margin-top: 10px">
                                                                            </div>
                                                                    
                                                                            <div class="col">
                                                                                <div class="card">
                                                                                    <div class="card-body">
                                                                                        <i class="far fa-smile fa-6x" style="color: #7999cd"></i>
                                                                                        <h4 class="mt-2">
                                                                                            puas
                                                                                        </h4>
                                                                                    </div>
                                                                                </div>
                                                                                <input type="radio" class="mt-2" id="option1" name="penilaian_tamu" value="puas"  style="margin-top: 10px">
                                                                            </div>
                                                                            <div class="col">
                                                                                <div class="card">
                                                                                    <div class="card-body">
                                                                                        <i class="far fa-frown fa-6x" style="color: #7999cd"></i>
                                                                                        <h4 class="mt-2">
                                                                                            tidak puas
                                                                                        </h4>
                                                                                    </div>
                                                                                </div>
                                                                                <input type="radio" class="mt-2" id="option1" name="penilaian_tamu"  value="tidak puas" style="margin-top: 10px">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                        <div class="modal-footer" style="margin-top: 84px;">
                                                                            <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
                                                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                                                        </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>                                                    
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                </table>
                            </div>
                            <div class="card-footer text-muted">2 days ago</div>
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
  <!-- Section: Design Block -->
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
        $('#tamuform').DataTable();
    });
</script>
@endsection

