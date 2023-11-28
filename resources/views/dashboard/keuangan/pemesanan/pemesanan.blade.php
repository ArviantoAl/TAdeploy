@extends('layouts.nowa',[
    'titlePage' => __('Form Pemesanan'),
])

@section('content')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <span class="main-content-title mg-b-0 mg-b-lg-1">Form Pemesanan</span>
        </div>
        <div class="justify-content-center mt-2">
            <ol class="breadcrumb">
                <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Pages</a></li>
                <li class="breadcrumb-item active" aria-current="page">Empty Page</li>
            </ol>
        </div>
    </div>
    <!-- /breadcrumb -->

    <!-- row -->
    <div class="row">
        <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12">
            <div class="card">
                <div class="card-body">
                    @if (session()->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ session()->get('error') }}</strong>
                            <button aria-label="Close" class="btn-close" data-bs-dismiss="alert" type="button"><span aria-hidden="true">&times;</span></button>
                        </div>
                    @endif
                    <div class="pd-30 pd-sm-20">
                        <div class="panel panel-primary">
                            <div class=" tab-menu-heading mb-2 border-bottom-0">
                                <div class="tabs-menu1">
                                    <ul class="nav panel-tabs">
                                        <li>
                                            <a href="#tab6" data-bs-toggle="tab" class="active">Pelanggan Baru</a>
                                        </li>
                                        <li>
                                            <a href="#tab7" data-bs-toggle="tab" class="">Pelanggan On Progress</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="panel-body tabs-menu-body border-0 p-3">
                                <div class="tab-content">
{{--                                    pelanggan baru--}}
                                    <div class="tab-pane active" id="tab6">
                                        <form id="form2" action="{{ route('keuangan_pelanggan_baru') }}">
                                            <div class="form-group">
                                                <label for="name" class="form-label">Nama</label>
                                                <input class="form-control" id="name" name="name" placeholder="Masukkan Nama Lengkap" type="text" required autocomplete="name" autofocus>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-6">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input class="form-control" id="email" name="email" placeholder="Masukkan Email" type="email" required autocomplete="email" autofocus>
                                                </div>
                                                <div class="form-group col-6">
                                                    <label for="username" class="form-label">No Hp</label>
                                                    <input class="form-control" id="username" name="username" placeholder="ex. 081902503960" type="number" required autocomplete="username" autofocus>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="ppn" class="form-label">PPN</label>
                                                <input id="ppn" class="checkbox" type="checkbox" checked>
                                            </div>
                                            <div class="form-divider">
                                                {{ __('Pesan Langganan') }}
                                            </div>

                                            <div class="form-group">
                                                <label for="layanan2" class="form-label">Layanan</label>
                                                <select name="layanan2" id="layanan2" class="form-control form-select select2" required data-bs-placeholder="Pilih Layanan">
                                                    <option value="0">Pilih Layanan</option>
                                                    @foreach ($layanan as $l)
                                                        <option value="{{ $l->id_layanan }}">{{ $l->nama_layanan}} -
                                                            {{rupiah($l->harga)}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-4">
                                                    <label for="mbts" class="form-label">Lokasi BTS</label>
                                                    <select name="mbts" id="mbts" class="form-control form-select select2" data-bs-placeholder="Pilih Lokasi BTS" required>
                                                        <option value="0">Pilih Lokasi BTS</option>
                                                        @foreach ($lokasi as $lok)
                                                            <option value="{{ $lok->id_master }}">{{ $lok->nama_master }}-{{ $lok->nama_lokasi }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group col-4">
                                                    <label for="bts2" class="form-label">Sambungkan ke Perangkat BTS</label>
                                                    <select name="bts2" id="bts2" class="form-control form-select select2"></select>
                                                </div>
                                                <div class="form-group col-4">
                                                    <label for="turunan2" class="form-label">Sambungkan ke Pelanggan</label>
                                                    <select name="turunan2" id="turunan2" class="form-control form-select select2"></select>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-6">
                                                    <label for="ip2" class="form-label">IP Address</label>
                                                    <input class="form-control" id="ip2" name="ip2" placeholder="Masukkan IP pelanggan" type="text" required autocomplete="ip2" autofocus>
                                                </div>
                                                <div class="form-group col-6">
                                                    <label for="ip_radio2" class="form-label">IP Radio</label>
                                                    <input class="form-control" id="ip_radio2" name="ip_radio2" placeholder="Masukkan IP Radio" type="text" required autocomplete="ip_radio2" autofocus>
                                                </div>
                                            </div>

                                            <div class="form-divider">
                                                {{ __('Alamat Pemasangan') }}
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-6">
                                                    <label for="provinsi2" class="form-label">Provinsi</label>
                                                    <select name="provinsi" id="provinsi2" class="form-control form-select select2" data-bs-placeholder="Pilih Provinsi" required>
                                                        <option value="0">Pilih Provinsi</option>
                                                        @foreach ($provinsi as $p)
                                                            <option value="{{ $p->id }}">{{ $p->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group col-6">
                                                    <label for="kabupaten2" class="form-label">Kabupaten/Kota</label>
                                                    <select name="kabupaten" id="kabupaten2" class="form-control form-select select2" required></select>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-6">
                                                    <label for="kecamatan2" class="form-label">Kecamatan</label>
                                                    <select name="kecamatan" id="kecamatan2" class="form-control form-select select2" required></select>
                                                </div>

                                                <div class="form-group col-6">
                                                    <label for="desa2" class="form-label">Desa/Kelurahan</label>
                                                    <select name="desa" id="desa2" class="form-control form-select select2" required></select>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-6">
                                                    <label for="alamat2" class="form-label">Alamat</label>
                                                    <textarea class="form-control" id="alamat2" placeholder="Masukkan Alamat Lengkap Pelanggan" required></textarea>
                                                </div>
                                                <div class="form-group col-6">
                                                    <label for="lokasi2" class="form-label">Koordinat Lokasi</label>
                                                    <input class="form-control" id="lokasi2" name="lokasi2" placeholder="ex. -7.551311,110.854192" type="text" autocomplete="lokasi2" autofocus>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-6">
                                                    <label for="rt2" class="form-label">RT</label>
                                                    <input class="form-control" id="rt2" name="rt2" placeholder="Masukkan RT (ex. 9)" type="number" required autocomplete="rt2" autofocus>
                                                </div>
                                                <div class="form-group col-6">
                                                    <label for="rw2" class="form-label">RW</label>
                                                    <input class="form-control" id="rw2" name="rw2" placeholder="Masukkan RW (ex. 9)" type="number" required autocomplete="rw2" autofocus>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary pd-x-30 mg-r-5 mg-t-5">Create</button>
                                        </form>
                                    </div>

{{--                                    pelanggan on progress--}}
                                    <div class="tab-pane" id="tab7">
                                        <form id="form3" method="POST" action="{{ route('keuangan_pelanggan_onprogress') }}">
                                            @csrf
                                            <div class="form-group">
                                                <label for="name3" class="form-label">Nama</label>
                                                <input class="form-control" id="name3" name="name" placeholder="Masukkan Nama Lengkap" type="text" required autocomplete="name" autofocus>
                                            </div>
                                            <div class="form-group">
                                                <label for="username3" class="form-label">No HP</label>
                                                <input class="form-control" id="username3" name="username" placeholder="ex. 081902503960" type="number" required autocomplete="username" autofocus>
                                            </div>


                                            <button type="submit" class="btn btn-primary pd-x-30 mg-r-5 mg-t-5">Create</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(function(){
            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
            });

            $(function () {
// pelanggan baru
                $('#mbts').on('change', function () {
                    var id_master = $('#mbts').val();
                    $.ajax({
                        type: "POST",
                        url: "{{route('getBts')}}",
                        data: {id_master: id_master},
                        cache: false,
                        success: function (msg) {
                            $('#bts2').html(msg);
                            $('#turunan2').html('');
                        },
                        error: function (data) {
                            console.log('error:', data);
                        }
                    })
                })
                $('#bts2').on('change', function () {
                    var id_bts2 = $('#bts2').val();
                    $.ajax({
                        type: "POST",
                        url: "{{route('getTurunan')}}",
                        data: {id_bts: id_bts2},
                        cache: false,
                        success: function (msg) {
                            $('#turunan2').html(msg);
                        },
                        error: function (data) {
                            console.log('error:', data);
                        }
                    })
                })
                $('#turunan2').on('change',function (){
                    var id_turunan2 = $('#turunan2').val();
                    console.log(id_turunan2);
                })
                $('#provinsi2').on('change',function (){
                    var id_provinsi2 = $('#provinsi2').val();
                    console.log(id_provinsi2)
                    $.ajax({
                        type : "POST",
                        url : "{{route('getKabupaten')}}",
                        data : {id_provinsi:id_provinsi2},
                        cache : false,
                        success: function (msg){
                            $('#kabupaten2').html(msg);
                            $('#kecamatan2').html('');
                            $('#desa2').html('');
                        },
                        error: function (data){
                            console.log('error:',data);
                        }
                    })
                })
                $('#kabupaten2').on('change',function (){
                    var id_kabupaten2 = $('#kabupaten2').val();
                    console.log(id_kabupaten2);
                    $.ajax({
                        type : "POST",
                        url : "{{route('getKecamatan')}}",
                        data : {id_kabupaten:id_kabupaten2},
                        cache : false,
                        success: function (msg){
                            $('#kecamatan2').html(msg);
                            $('#desa2').html('');
                        },
                        error: function (data){
                            console.log('error:',data);
                        }
                    })
                })
                $('#kecamatan2').on('change',function (){
                    var id_kecamatan2 = $('#kecamatan2').val();
                    console.log(id_kecamatan2);
                    $.ajax({
                        type : "POST",
                        url : "{{route('getDesa')}}",
                        data : {id_kecamatan:id_kecamatan2},
                        cache : false,
                        success: function (msg){
                            $('#desa2').html(msg);
                        },
                        error: function (data){
                            console.log('error:',data);
                        }
                    })
                })
                $('#desa2').on('change',function (){
                    var id_desa2 = $('#desa2').val();
                    console.log(id_desa2);
                })
                $("#form2").submit(function (e) {
                    e.preventDefault();
                    var name = $('#name').val();
                    var email = $('#email').val();
                    var username = $('#username').val();
                    var ppn = $('#ppn').prop('checked') === true ? 1 : 0;
                    var id_layanan = $('#layanan2').val();
                    var id_bts = $('#bts2').val();
                    var id_turunan = $('#turunan2').val();
                    var ip = $('#ip2').val();
                    var ip_radio = $('#ip_radio2').val();
                    var id_provinsi = $('#provinsi2').val();
                    var id_kabupaten = $('#kabupaten2').val();
                    var id_kecamatan = $('#kecamatan2').val();
                    var id_desa = $('#desa2').val();
                    var id_alamat = $('#alamat2').val();
                    var lokasi = $('#lokasi2').val();
                    var rt = $('#rt2').val();
                    var rw = $('#rw2').val();
                    console.log(id_alamat);
                    $.ajax({
                        type: "POST",
                        url: "{{route('pelanggan_baru')}}",
                        data: {
                            name: name,
                            email: email,
                            username: username,
                            ppn: ppn,
                            id_layanan: id_layanan,
                            id_bts: id_bts,
                            id_turunan: id_turunan,
                            ip: ip,
                            ip_radio: ip_radio,
                            id_provinsi: id_provinsi,
                            id_kabupaten: id_kabupaten,
                            id_kecamatan: id_kecamatan,
                            id_desa: id_desa,
                            id_alamat: id_alamat,
                            lokasi: lokasi,
                            rt: rt,
                            rw: rw,
                        },
                        cache: false,
                        success: function (data) {
                            if(data.cek === 0){
                                alert(data.msg);
                            }else if(data.cek === 1){
                                alert(data.msg);
                            }else if(data.cek === 2){
                                alert(data.msg);
                            }else if(data.cek === 3){
                                alert(data.msg);
                            }else if(data.cek === 4){
                                alert(data.msg);
                            }else if(data.cek === 5){
                                alert(data.msg);
                            }else if(data.cek === 6){
                                alert(data.msg);
                            }else if(data.cek === 7){
                                alert(data.msg);
                            }else if(data.cek === 8){
                                alert(data.msg);
                            }else {
                                console.log('success: ' + data);
                                window.location.href = "{{route('keuangan.pelangganaktif','status=2')}}";
                            }
                        },
                        error: function (data) {
                            var errors = data.responseJSON;
                            console.log(errors);
                        }
                    })
                })
// end
            })
        });
    </script>
@endsection
