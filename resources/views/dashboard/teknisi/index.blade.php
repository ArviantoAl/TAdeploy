@extends('layouts.nowa',[
    'titlePage' => __('Dashboard Teknisi'),
    'sub' => ' '
])

{{-- @section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        anda adalah Teknisi
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection --}}

@section('content')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <span class="main-content-title mg-b-0 mg-b-lg-1">Dashboard Teknisi</span>
        </div>
        <div class="justify-content-center mt-2">
            <ol class="breadcrumb">
                <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Data Peta Langganan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Peta Langganan</li>
            </ol>
        </div>
    </div>
    <!-- /breadcrumb -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="main-content-label mg-b-5">
                        Anda adalah teknisi.
                    </div>
                    <p class="mg-b-20"></p>
                    <div class="ht-500" id="leaflet2"></div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
    <!--Internal  Leaflet-maps js -->
    <script src="{{ asset('nowa_assets') }}/plugins/leaflet/leaflet.js"></script>

    <script>
        let cv = JSON.parse('{!! json_encode($cv) !!}');
        let lang = JSON.parse('{!! json_encode($lang) !!}');
        let master = JSON.parse('{!! json_encode($master) !!}');

        var greenIcon = new L.Icon({
            iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png',
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        });
        var blueIcon = new L.Icon({
            iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-blue.png',
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        });
        var yellowIcon = new L.Icon({
            iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-yellow.png',
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        });

        var map = L.map('leaflet2').setView([cv.latitude, cv.longitude], 10);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);
        for (var i = 0; i < lang.length; i++){
            L.marker([lang[i]['latitude'],lang[i]['longitude']], {icon: greenIcon}).addTo(map)
                .bindPopup('Nama Pelanggan: '+lang[i]['nama']+
                    '<br>Layanan: '+lang[i]['layanan']+
                    '<br>Status: '+lang[i]['status']+
                    '<br>Alamat: '+lang[i]['alamat']
                )
                .openPopup();
        }
        for (var j = 0; j < master.length; j++){
            L.marker([master[j]['latitude'],master[j]['longitude']], {icon: yellowIcon}).addTo(map)
                .bindPopup('Nama BTS: '+master[j]['nama']+
                    '<br>Lokasi: '+master[j]['alamat']
                )
                .openPopup();
        }
        L.marker([cv.latitude, cv.longitude], {icon: blueIcon}).addTo(map)
            .bindPopup(cv.nama_cv+
                '<br>Alamat: '+cv.alamat
            )
            .openPopup();

        // L.marker([-7.7246776, 110.9562274]).addTo(map)
        //     .bindPopup('A pretty CSS3 popup.<br> Easily customizable.')
        //     .openPopup();
    </script>
@endsection
