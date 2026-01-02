@extends('layouts.master-admin')

@section('title', "Dashboard")

@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <a href="#" class="btn btn-sm btn-accent">
                <i class="bi bi-download"></i> Generate Report
            </a>
        </div>

        <div class="row">
            <div class="col-xl-8 col-lg-8">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header">
                        Kunjungan
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div id="chartKunjungan" style="width:100%; height:400px;"></div>
                        <!--<div class="chart-pie pt-4 pb-2">
                            <canvas id="chartKunjungan"></canvas>
                        </div>-->
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-lg-4">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header">
                        Konten Populer
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        @if(isset($konten_populer))
                        <ol class="list-group list-group-numbered lh-1">
                            @foreach($konten_populer as $key => $value)
                                @if($value->klik > 0)
                                    <li class="list-group-item d-flex justify-content-between align-items-start small">
                                        <div class="ms-2 me-auto">
                                            <div class="fw-regular">{{$value->judul}}</div>
                                            <span class="text-muted mt-1">{{$kontens[$value->jns]}}</span>
                                        </div>
                                        <span class="badge bg-accent rounded-pill">{{$value->klik}} Views</span>
                                    </li>
                                @endif
                          @endforeach
                        </ol>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header">
                        Buku Tamu
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        @if(isset($bukutamu))
                            <div class="list-group lh-sm">
                                @foreach($bukutamu as $key => $value)   
                                    <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-start">
                                        <div class="ms-2 me-auto">
                                            <span class="small">{{$value->nama}} / {{$value->email}}</span>
                                            <div class="fw-regular">{{$value->pesan}}</div>
                                        </div>
                                        <span class="badge bg-accent rounded-pill">{{$value->created_at}}</span>
                                    </a>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
    
@endsection
@push('scripts')
    
    <script type="text/javascript">
        window.onload = (event)=> {
            const chartKunjungan = document.getElementById('chartKunjungan')
            if(chartKunjungan){
                const kunjungan = @json($kunjungan);
                // console.log(kunjungan)
                const categories = Object.keys(kunjungan);
                const series = Object.values(kunjungan);

                const chart = Highcharts.chart({
                    chart: {
                        renderTo: 'chartKunjungan',
                        type: 'line',
                        options3d: {
                            enabled: true,
                            alpha: 5,
                            beta: 15,
                            depth: 50,
                            viewDistance: 25
                        },
                    },
                    title: {
                        text: null,
                    },
                    xAxis: {
                        categories: categories,
                    },
                    yAxis: {
                        title: {
                            text: 'Jumlah'
                        }
                    },
                    plotOptions: {
                        column: {
                            depth: 25
                        }
                    },
                    series: [{
                        name: 'Pengunjung',
                        data: series,
                    }]
                });
            }
        }
    </script>

@endpush