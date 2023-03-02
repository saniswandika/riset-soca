@extends('layouts.masterTemplate')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>

    <!-- Content Row -->

    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area" >
                        <canvas id="myChart" style="width: 20px" ></canvas>
                    </div>
                </div>
            </div>
        </div>

        {{-- <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-5">
                <!-- Card Header - Dropdown -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Penilaian Tamu</h6>
                    </div>
                    <div class="card-body">
                        <h4 class="small font-weight-bold">Penilaian Tamu Response sangat puas<span
                                class="float-right">{{ $baik }}%</span></h4>
                        <div class="progress mb-4">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: <?php echo $baik; ?>%"
                                aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>                        
                        <h4 class="small font-weight-bold">Penilaian Tamu Response puas <span
                                class="float-right">{{ $Cukup }}%</span></h4>
                        <div class="progress mb-4">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: <?php echo $Cukup; ?>%"
                                aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <h4 class="small font-weight-bold">Penilaian Tamu Response tidak puas<span
                                class="float-right">{{ $Buruk }}%</span></h4>
                        <div class="progress mb-4">
                            <div class="progress-bar" role="progressbar" style="width: <?php echo $Buruk; ?>%"
                                aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
        </div> --}}
    </div>

</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  
{{-- <script type="text/javascript">
  
    var labels =  {{ Js::from($labels) }};
    var users =  {{ Js::from($data) }};
  
    const data = {
        labels: labels,
        datasets: [{
            label: 'Grafik Tamu Perbulan',
            backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(255, 99, 132)',
            data: users,
        }]
    };
  
    const config = {
        type: 'line',
        data: data,
        options: {}
    };
  
    const myChart = new Chart(
        document.getElementById('myChart'),
        config
    );
  
</script> --}}

@endsection
