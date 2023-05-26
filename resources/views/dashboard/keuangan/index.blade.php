@extends('layouts.nowa',[
    'titlePage' => __('Dashboard Keangan'),
])

@section('content')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <span class="main-content-title mg-b-0 mg-b-lg-1">Dashboard Keangan</span>
        </div>
        <div class="justify-content-center mt-2">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Dashboard Keangan</li>
            </ol>
        </div>
    </div>
    <!-- /breadcrumb -->

    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Anda adalah Keuangan</strong>
        <button aria-label="Close" class="btn-close" data-bs-dismiss="alert" type="button"><span aria-hidden="true">&times;</span></button>
    </div>
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
        <form>
            <div class="row row-xs">
                <div class="form-group col-md-1">
                    <select name="bulan" id="bulan" class="form-control form-select select2" data-placeholder="Filter Bulan">
                        @foreach ($bulan as $key => $b)
                            <option value="{{ $vabulan[$key] }}" {{ $vabulan[$key] == $selected ? 'selected' : '' }}>{{$b}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-1">
                    <select name="tahun" id="tahun" class="form-control form-select select2" data-placeholder="Filter Bulan">
                        @foreach ($tahun as $key => $t)
                            <option value="{{ $t }}" {{ $t == $selected2 ? 'selected' : '' }}>{{$t}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-1">
                    <button type="button" id="export" class="btn btn-primary btn-block">Export Filter</button>
                </div>
                <div class="form-group col-md-1">
                    <button type="button" id="export2" class="btn btn-primary btn-block">Export Semua</button>
                </div>
            </div>
        </form>
        <!-- <div class="container"> -->
        <!-- row -->
        <div class="row row-sm">
            <div class="col-sm-12 col-md-12">
                <div class="card overflow-hidden">
                    <div class="card-body">
                        <div class="main-content-label mg-b-5">
                            Line Chart
                        </div>
                        <p class="mg-b-20">Basic Charts Of Nowa template.</p>
                        <div class="chartjs-wrapper-demo" id="chart">
                            <canvas id="chartLine111"></canvas>
                        </div>
                    </div>
                </div>
            </div><!-- col-6 -->
        </div>
        <!-- /row -->
        <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-12 col-xs-12">
                <div class="card sales-card circle-image1">
                    <div class="row">
                        <div class="col-9">
                            <div class="ps-4 pt-4 pe-3 pb-4">
                                <div class="">
                                    <h6 class="mb-2 tx-12 ">Jumlah Invoice</h6>
                                </div>
                                <div class="pb-0 mt-0">
                                    <div class="d-flex">
                                        <h4 id="ainv" class="tx-20 font-weight-semibold mb-2"></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="circle-icon bg-info-transparent text-center align-self-center overflow-hidden">
                                <i class="fa fa-file-invoice tx-16 text-info"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-12 col-xs-12">
                <div class="card sales-card circle-image2">
                    <div class="row">
                        <div class="col-9">
                            <div class="ps-4 pt-4 pe-3 pb-4">
                                <div class="">
                                    <h6 class="mb-2 tx-12">Invoice Terbayar</h6>
                                </div>
                                <div class="pb-0 mt-0">
                                    <div class="d-flex">
                                        <h4 id="binv" class="tx-20 font-weight-semibold mb-2"></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="circle-icon bg-primary-transparent text-center align-self-center overflow-hidden">
                                <i class="fa fa-file-invoice tx-16 text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-12 col-xs-12">
                <div class="card sales-card circle-image2">
                    <div class="row">
                        <div class="col-9">
                            <div class="ps-4 pt-4 pe-3 pb-4">
                                <div class="">
                                    <h6 class="mb-2 tx-12">Invoice Belum Dibayar</h6>
                                </div>
                                <div class="pb-0 mt-0">
                                    <div class="d-flex">
                                        <h4 id="cinv" class="tx-20 font-weight-semibold mb-2"></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="circle-icon bg-warning-transparent text-center align-self-center overflow-hidden">
                                <i class="fa fa-file-invoice tx-16 text-warning"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-12 col-xs-12">
                <div class="card sales-card circle-image2">
                    <div class="row">
                        <div class="col-9">
                            <div class="ps-4 pt-4 pe-3 pb-4">
                                <div class="">
                                    <h6 class="mb-2 tx-12">Invoice Tidak Dibayar</h6>
                                </div>
                                <div class="pb-0 mt-0">
                                    <div class="d-flex">
                                        <h4 id="dinv" class="tx-20 font-weight-semibold mb-2"></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="circle-icon bg-secondary-transparent text-center align-self-center overflow-hidden">
                                <i class="fa fa-file-invoice tx-16 text-secondary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-3 col-md-12 col-xs-12">
                <div class="card sales-card circle-image1">
                    <div class="row">
                        <div class="col-9">
                            <div class="ps-4 pt-4 pe-3 pb-4">
                                <div class="">
                                    <h6 class="mb-2 tx-12 ">Total Invoice</h6>
                                </div>
                                <div class="pb-0 mt-0">
                                    <div class="d-flex">
                                        <h4 id="totalinv" class="tx-20 font-weight-semibold mb-2"></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="circle-icon bg-info-transparent text-center align-self-center overflow-hidden">
                                <i class="fa fa-dollar-sign tx-16 text-info"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-12 col-xs-12">
                <div class="card sales-card circle-image2">
                    <div class="row">
                        <div class="col-9">
                            <div class="ps-4 pt-4 pe-3 pb-4">
                                <div class="">
                                    <h6 class="mb-2 tx-12">Invoice Terbayar</h6>
                                </div>
                                <div class="pb-0 mt-0">
                                    <div class="d-flex">
                                        <h4 id="terbinv" class="tx-20 font-weight-semibold mb-2"></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="circle-icon bg-primary-transparent text-center align-self-center overflow-hidden">
                                <i class="fa fa-dollar-sign tx-16 text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-12 col-xs-12">
                <div class="card sales-card circle-image2">
                    <div class="row">
                        <div class="col-9">
                            <div class="ps-4 pt-4 pe-3 pb-4">
                                <div class="">
                                    <h6 class="mb-2 tx-12">Invoice Belum Dibayar</h6>
                                </div>
                                <div class="pb-0 mt-0">
                                    <div class="d-flex">
                                        <h4 id="belinv" class="tx-20 font-weight-semibold mb-2"></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="circle-icon bg-warning-transparent text-center align-self-center overflow-hidden">
                                <i class="fa fa-dollar-sign tx-16 text-warning"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-12 col-xs-12">
                <div class="card sales-card circle-image2">
                    <div class="row">
                        <div class="col-9">
                            <div class="ps-4 pt-4 pe-3 pb-4">
                                <div class="">
                                    <h6 class="mb-2 tx-12">Invoice Tidak Dibayar</h6>
                                </div>
                                <div class="pb-0 mt-0">
                                    <div class="d-flex">
                                        <h4 id="batinv" class="tx-20 font-weight-semibold mb-2"></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="circle-icon bg-secondary-transparent text-center align-self-center overflow-hidden">
                                <i class="fa fa-dollar-sign tx-16 text-secondary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>

    <!--Internal  Chart.bundle js -->
    <script src="{{ asset('nowa_assets') }}/plugins/chart.js/Chart.bundle.min.js"></script>
    <script type="text/javascript">
        const formatRupiah = (money) => {
            return new Intl.NumberFormat('id-ID',
                { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }
            ).format(money);
        }

        let _aline = JSON.parse('{!! json_encode($namabulans) !!}');
        let _bline = JSON.parse('{!! json_encode($bulanCount) !!}');
        let _cbatas = JSON.parse('{!! json_encode($batas_max) !!}');
        let _dline = JSON.parse('{!! json_encode($terCount) !!}');
        let _eline = JSON.parse('{!! json_encode($belCount) !!}');
        let _fline = JSON.parse('{!! json_encode($batCount) !!}');

        var data = {
            labels: _aline,
            datasets: [
                {
                    label: "Jumlah Invoice",
                    data: _bline,
                    backgroundColor: '#4ec2f0'
                }, {
                    label: "Invoice Terbayar",
                    data: _dline,
                    backgroundColor: '#1a9c86',
                },{
                    label: "Invoice Belum Dibayar",
                    data: _eline,
                    backgroundColor: '#ffbd5a',
                },{
                    label: "Invoice Tidak Dibayar",
                    data: _fline,
                    backgroundColor: '#f74f75',
                },
            ]
        };
        var option = {
            maintainAspectRatio: false,
            legend: {
                display: true,
                labels: {
                    useLineStyle: false,
                    display: false
                }
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        fontSize: 10,
                        max: _cbatas,
                        fontColor: "rgba(171, 167, 167,0.9)",
                        callback: function(value, index, ticks) {
                            return formatRupiah(value);
                        }
                    },
                    gridLines: {
                        display: true,
                        color: 'rgba(171, 167, 167,0.2)',
                        drawBorder: false
                    },
                }],
                xAxes: [{
                    ticks: {
                        beginAtZero: true,
                        fontSize: 11,
                        fontColor: "rgba(171, 167, 167,0.9)",
                    },
                    gridLines: {
                        display: true,
                        color: 'rgba(171, 167, 167,0.2)',
                        drawBorder: false
                    },
                }]
            },
        };
        var type = 'bar';

        var ctx8 = document.getElementById('chartLine111');
        var myChart = new Chart(ctx8, {
            type: type,
            data: data,
            options: option,
        });

        $(function () {
            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
            });
            $('#export').click(function () {
                let bulan = $('#bulan').val();
                let tahun = $('#tahun').val();
                $.ajax({
                    type: "POST",
                    url: "{{route('admin.exportfilter')}}",
                    data: {
                        bulan: bulan,
                        tahun: tahun,
                    },
                    xhrFields:{
                        responseType: 'blob'
                    },
                    success: function(data)
                    {
                        var link = document.createElement('a');
                        link.href = window.URL.createObjectURL(data);
                        link.download = 'datafilter.xlsx';
                        link.click();
                    },
                    error: function (data) {
                        console.log('error:', data);
                    }
                })
            })
            $('#export2').click(function () {
                $.ajax({
                    type: "POST",
                    url: "{{route('admin.exportsemua')}}",
                    xhrFields:{
                        responseType: 'blob'
                    },
                    success: function(data)
                    {
                        var link = document.createElement('a');
                        link.href = window.URL.createObjectURL(data);
                        link.download = 'datasemua.xlsx';
                        link.click();
                    },
                    error: function (data) {
                        console.log('error:', data);
                    }
                })
            })
// pelanggan baru
            var ainv = JSON.parse('{!! json_encode($h_invoice) !!}');
            let binv = JSON.parse('{!! json_encode($h_terbayar) !!}');
            let cinv = JSON.parse('{!! json_encode($h_belumbayar) !!}');
            let dinv = JSON.parse('{!! json_encode($h_tidakbayar) !!}');
            $('#ainv').html(ainv);
            $('#binv').html(binv);
            $('#cinv').html(cinv);
            $('#dinv').html(dinv);

            let totalinv = JSON.parse('{!! json_encode($total) !!}');
            let belinv = JSON.parse('{!! json_encode($bel) !!}');
            let terbinv = JSON.parse('{!! json_encode($ter) !!}');
            let batinv = JSON.parse('{!! json_encode($bat) !!}');
            $('#totalinv').html(formatRupiah(totalinv));
            $('#belinv').html(formatRupiah(belinv));
            $('#terbinv').html(formatRupiah(terbinv));
            $('#batinv').html(formatRupiah(batinv));

            $('#bulan').on('change',function (){
                var bulan = $('#bulan').val();
                var tahun = $('#tahun').val();
                $.ajax({
                    type : "POST",
                    url : "{{route('ainv')}}",
                    data : {
                        bulan:bulan,
                        tahun:tahun
                    },
                    cache : false,
                    success: function (msg){
                        $('#ainv').html(msg.h_invoice);
                        $('#binv').html(msg.h_terbayar);
                        $('#cinv').html(msg.h_belumbayar);
                        $('#dinv').html(msg.h_tidakbayar);
                        $('#totalinv').html(formatRupiah(msg['total']));
                        $('#terbinv').html(formatRupiah(msg['ter']));
                        $('#belinv').html(formatRupiah(msg['bel']));
                        $('#batinv').html(formatRupiah(msg['bat']));
                        // console.log(msg['h_invoice']);
                    },
                    error: function (data){
                        console.log('error:',data);
                    }
                })
            })
            $('#tahun').on('change',function (){
                var bulan = $('#bulan').val();
                var tahun = $('#tahun').val();
                $.ajax({
                    type : "POST",
                    url : "{{route('binv')}}",
                    data : {
                        bulan:bulan,
                        tahun:tahun
                    },
                    cache : false,
                    success: function (msg){
                        $('#ainv').html(msg.h_invoice);
                        $('#binv').html(msg.h_terbayar);
                        $('#cinv').html(msg.h_belumbayar);
                        $('#dinv').html(msg.h_tidakbayar);
                        $('#totalinv').html(formatRupiah(msg['total']));
                        $('#terbinv').html(formatRupiah(msg['ter']));
                        $('#belinv').html(formatRupiah(msg['bel']));
                        $('#batinv').html(formatRupiah(msg['bat']));

                        $('#chartLine111').remove(); // this is my <canvas> element
                        $('#chart').append('<canvas id="chartLine111"><canvas>');

                        var ctx8 = document.getElementById('chartLine111');
                        var myChart2 = new Chart(ctx8, {
                            type: type,
                            data: {
                                labels: msg.namabulans,
                                datasets: [
                                    {
                                        label: "Jumlah Invoice",
                                        data: msg.bulanCount,
                                        borderColor: '#4ec2f0',
                                        borderWidth: 1,
                                        fill: false
                                    }, {
                                        label: "Invoice Terbayar",
                                        data: msg.terCount,
                                        borderColor: '#1a9c86',
                                        borderWidth: 1,
                                        fill: false
                                    },{
                                        label: "Invoice Belum Dibayar",
                                        data: msg.belCount,
                                        borderColor: '#ffbd5a',
                                        borderWidth: 1,
                                        fill: false
                                    },{
                                        label: "Invoice Tidak Dibayar",
                                        data: msg.batCount,
                                        borderColor: '#f74f75',
                                        borderWidth: 1,
                                        fill: false
                                    },
                                ]
                            },
                            options: {
                                maintainAspectRatio: false,
                                legend: {
                                    display: true,
                                    labels: {
                                        useLineStyle: true,
                                        display: false
                                    }
                                },
                                scales: {
                                    yAxes: [{
                                        ticks: {
                                            beginAtZero: true,
                                            fontSize: 10,
                                            max: msg.batas_max,
                                            fontColor: "rgba(171, 167, 167,0.9)",
                                        },
                                        gridLines: {
                                            display: true,
                                            color: 'rgba(171, 167, 167,0.2)',
                                            drawBorder: false
                                        },
                                    }],
                                    xAxes: [{
                                        ticks: {
                                            beginAtZero: true,
                                            fontSize: 11,
                                            fontColor: "rgba(171, 167, 167,0.9)",
                                        },
                                        gridLines: {
                                            display: true,
                                            color: 'rgba(171, 167, 167,0.2)',
                                            drawBorder: false
                                        },
                                    }]
                                }
                            },
                        });

                        myChart2.render();
                        // console.log(msg['h_invoice']);
                    },
                    error: function (data){
                        console.log('error:',data);
                    }
                })
            })
        })
    </script>
    <!--Internal Chartjs js -->
    <script src="{{ asset('nowa_assets') }}/js/chart.chartjs.js"></script>
@endsection
