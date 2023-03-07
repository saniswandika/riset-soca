<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet" type="text/css">
    @stack('style')

</head>

<body id="page-top" style="background-color:#2c304d">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav  sidebar sidebar-dark accordion" style="" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html"
                style="
            background-color: white;
            margin-bottom: -3%;">
                <div class="sidebar-brand-icon">
                    <img src="{{ asset('assets/img/logo.png') }}" style="height: 50px;" alt="..." />
                </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-2">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item {{ request()->is('home') ? 'active' : '' }}">
                <a class="nav-link active" href="/home" >
                    <i class="fas fa-fw fa-tachometer-alt" style="font-size: 120%"></i>
                    <span style="font-size: 120%">Dashboard</span></a>
            </li>
            
            <hr class="sidebar-divider">
            {{-- menu kelurahan --}}
            <div class="sidebar-heading"  style="font-size: 60%">
                Kelurahan
            </div>
            <li class="nav-item {{ request()->is('pengaduans') ? 'active' : '' }}">
                <a class="nav-link" href="/pengaduans">
                    <i class="fas fa-fw fa-table" ></i>
                    <span style="font-size: 90%">Pengaduan & Rujukan</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span  style="font-size: 90%">Rekomendasi</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Menu Rekomendasi:</h6>
                        <a class="collapse-item" href="rekomendasi_admin_kependudukans">Rekomendasi Admin Kependudukan</a>
                        <a class="collapse-item" href="rekomendasi_bantuan_pendidikans">Rekomendasi Bantuan Pendidikan</a>
                        <a class="collapse-item" href="rekomendasi_biaya_perawatans">Rekomendasi Biaya Perawatan</a>
                        <a class="collapse-item" href="rekomendasi_keringanan_pbbs">Rekomendasi Keringanan PBB</a>
                        <a class="collapse-item" href="rekomendasi_pengangkatan_anaks">Rekomendasi Pengangkatan Anak</a>
                        <a class="collapse-item" href="rekomendasi_pub">Rekomendasi PUB</a>
                        <a class="collapse-item" href="rekomendasi_rehabilitasi_sosials">Rekomendasi Rehabilitasi Sosial</a>
                        <a class="collapse-item" href="rekomendasi_rekativasi_pbi_jks">Rekomendasi Rekativasi PBI JK</a>
                        <a class="collapse-item" href="rekomendasi_terdaftar_dtks">Rekomendasi Terdaftar DTKS</a>
                        <a class="collapse-item" href="rekomendasi_terdaftar_yayasans">Rekomendasi Terdaftar Yayasan</a>
                        {{-- <div class="collapse-divider"></div>
                        <h6 class="collapse-header">Other Pages:</h6>
                        <a class="collapse-item" href="404.html">404 Page</a>
                        <a class="collapse-item" href="blank.html">Blank Page</a> --}}
                    </div>
                </div>
            </li>
            {{-- menu Rekomendasi --}}
            {{-- Pengaturan Akun dan Hak Ases --}}
            <hr class="sidebar-divider">
            <div class="sidebar-heading">
                Pengaturan Akun dan Hak Ases
            </div>
            <!-- Nav Item - Tables -->
            <li class="nav-item {{ request()->is('roles') ? 'active' : '' }}">
                <a class="nav-link" href="/roles">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Management Role User</span></a>
            </li>
            <li class="nav-item {{ request()->is('users') ? 'active' : '' }}">
                <a class="nav-link" href="/users">
                    <i class="fas fa-fw fa-table"></i>
                    <span>management akun</span></a>
            </li>
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
            {{-- Pengaturan Akun dan Hak Ases --}}
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    @if (Route::is('laporanTamu'))
                        <div class="mt-4">
                            <h5 class="card-title">Menu Laporan Tamu</h5>
                        </div>
                    @endif
                    @if (Route::is('home'))
                        <div class="mt-4">
                            <h5 class="card-title">Menu Dashboard</h5>
                        </div>
                    @endif


                    {{-- <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form> --}}

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"> {{ Auth::user()->name }}
                                </span>
                                <img class="img-profile rounded-circle"
                                    src="{{ asset('assets/img/undraw_profile.svg') }}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="/profile">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="/Pengaturan_wilayah">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Pengaturan Wilayah
                                </a>{{-- 
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a> --}}
                                <div class="dropdown-divider"></div>
                                
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>

                    </ul>

                </nav>
                <main class="py-4">
                    @yield('content')
                </main>
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}" rel="stylesheet"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}" rel="stylesheet"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}" rel="stylesheet"></script>


    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}" rel="stylesheet"></script>


    <!-- Page level plugins -->
    <script src="{{ asset('vendor/chart.js/Chart.min.js') }}" rel="stylesheet"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('js/demo/chart-area-demo.js') }}" rel="stylesheet"></script>
    <script src="{{ asset('js/demo/chart-pie-demo.js') }}" rel="stylesheet"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#datablepemakaian').DataTable();
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#tableuser').DataTable();
        });
    </script>
@include('sweetalert::alert')
@stack('script')
</body>

</html>
