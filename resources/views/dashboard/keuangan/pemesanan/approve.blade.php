@extends('layouts.nowa',[
    'titlePage' => __('Form Approval Langganan'),
])

@section('content')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <span class="main-content-title mg-b-0 mg-b-lg-1">Form Approval Langganan</span>
        </div>
        <div class="justify-content-center mt-2">
            <ol class="breadcrumb">
                <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Data Langganan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Form Approval Langganan</li>
            </ol>
        </div>
    </div>
    <!-- /breadcrumb -->

    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
        <div class="card  box-shadow-0 ">
            <div class="card-header">
                <h4 class="card-title mb-1">Form Approval Langganan</h4>
                <p class="mb-2">Isi data untuk melengkapi data langganan.</p>
            </div>
            <div class="card-body pt-0">
                <form id="form" action="{{ route('admin.postapprove') }}">
                    <div class="form-group">
                        <label for="user" class="form-label">Nama Pelanggan</label>
                        <input class="form-control" value="{{$user->name}}" type="text" disabled>
                        <label for="user" class="form-label">No Hp</label>
                        <input class="form-control" value="{{$user->username}}" type="text" disabled>
                        <input type="hidden" value="{{$user->id_user}}" id="user" name="user">
                    </div>

                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input class="form-control" id="email" name="email" placeholder="Masukkan Email" type="email" required autocomplete="email" autofocus>
                    </div>
                    <div class="form-group">
                        <label for="ppn" class="form-label">PPN</label>
                        <input id="ppn" class="checkbox" type="checkbox" checked>
                    </div>

                    <div class="form-group">
                        <label for="layanan" class="form-label">Layanan</label>
                        <select name="layanan" id="layanan" class="form-control form-select select2" data-bs-placeholder="Pilih Layanan">
                            <option value="0">Pilih Layanan</option>
                            @foreach ($layanan as $l)
                                <option value="{{ $l->id_layanan }}">{{ $l->nama_layanan }} -
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
                            <label for="bts" class="form-label">Sambungkan ke Perangkat BTS</label>
                            <select name="bts" id="bts" class="form-control form-select select2"></select>
                        </div>
                        <div class="form-group col-4">
                            <label for="turunan" class="form-label">Sambungkan ke Pelanggan</label>
                            <select name="turunan" id="turunan" class="form-control form-select select2"></select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-6">
                            <label for="ip" class="form-label">IP Address</label>
                            <input class="form-control" id="ip" name="ip" placeholder="Masukkan IP pelanggan" type="text" required autocomplete="ip" autofocus>
                        </div>
                        <div class="form-group col-6">
                            <label for="ip_radio" class="form-label">IP Radio</label>
                            <input class="form-control" id="ip_radio" name="ip_radio" placeholder="Masukkan IP Radio" type="text" required autocomplete="ip_radio" autofocus>
                        </div>
                    </div>

                    <div class="form-divider">
                        {{ __('Alamat Pemasangan') }}
                    </div>

                    <div class="row">
                        <div class="form-group col-6">
                            <label for="provinsi" class="form-label">Provinsi</label>
                            <select name="provinsi" id="provinsi" class="form-control form-select select2" data-bs-placeholder="Pilih Provinsi">
                                <option value="0">Pilih Provinsi</option>
                                @foreach ($provinsi as $p)
                                    <option value="{{ $p->id }}">{{ $p->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-6">
                            <label for="kabupaten" class="form-label">Kabupaten/Kota</label>
                            <select name="kabupaten" id="kabupaten" class="form-control form-select select2"></select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-6">
                            <label for="kecamatan" class="form-label">Kecamatan</label>
                            <select name="kecamatan" id="kecamatan" class="form-control form-select select2"></select>
                        </div>

                        <div class="form-group col-6">
                            <label for="desa" class="form-label">Desa/Kelurahan</label>
                            <select name="desa" id="desa" class="form-control form-select select2"></select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-6">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea class="form-control" id="alamat" placeholder="Masukkan Alamat Lengkap Pelanggan" required></textarea>
                        </div>
                        <div class="form-group col-6">
                            <label for="lokasi" class="form-label">Koordinat Lokasi</label>
                            <input class="form-control" id="lokasi" name="lokasi" placeholder="ex. -7.551311,110.854192" type="text" autocomplete="lokasi" autofocus>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="rt" class="form-label">RT</label>
                            <input class="form-control" id="rt" name="rt" placeholder="Masukkan RT (ex. 9)" type="number" required autocomplete="rt" autofocus>
                        </div>
                        <div class="form-group col-6">
                            <label for="rw" class="form-label">RW</label>
                            <input class="form-control" id="rw" name="rw" placeholder="Masukkan RW (ex. 9)" type="number" required autocomplete="rw" autofocus>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3 mb-0">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(function(){
            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
            });

            $(function () {
                let l = $('#email').val();
                console.log(l);
// pelanggan lama
                $('#mbts').on('change', function () {
                    var id_master = $('#mbts').val();
                    $.ajax({
                        type: "POST",
                        url: "{{route('getBts')}}",
                        data: {id_master: id_master},
                        cache: false,
                        success: function (msg) {
                            $('#bts').html(msg);
                            $('#turunan').html('');
                        },
                        error: function (data) {
                            console.log('error:', data);
                        }
                    })
                })
                $('#bts').on('change', function () {
                    var id_bts = $('#bts').val();
                    console.log(id_bts);
                    $.ajax({
                        type: "POST",
                        url: "{{route('getTurunan')}}",
                        data: {id_bts: id_bts},
                        cache: false,
                        success: function (msg) {
                            $('#turunan').html(msg);
                        },
                        error: function (data) {
                            console.log('error:', data);
                        }
                    })
                })
                $('#turunan').on('change',function (){
                    var id_turunan = $('#turunan').val();
                    console.log(id_turunan);
                })
                $('#provinsi').on('change',function (){
                    var id_provinsi = $('#provinsi').val();
                    console.log(id_provinsi)
                    $.ajax({
                        type : "POST",
                        url : "{{route('getKabupaten')}}",
                        data : {id_provinsi:id_provinsi},
                        cache : false,
                        success: function (msg){
                            $('#kabupaten').html(msg);
                            $('#kecamatan').html('');
                            $('#desa').html('');
                        },
                        error: function (data){
                            console.log('error:',data);
                        }
                    })
                })
                $('#kabupaten').on('change',function (){
                    var id_kabupaten = $('#kabupaten').val();
                    console.log(id_kabupaten);
                    $.ajax({
                        type : "POST",
                        url : "{{route('getKecamatan')}}",
                        data : {id_kabupaten:id_kabupaten},
                        cache : false,
                        success: function (msg){
                            $('#kecamatan').html(msg);
                            $('#desa').html('');
                        },
                        error: function (data){
                            console.log('error:',data);
                        }
                    })
                })
                $('#kecamatan').on('change',function (){
                    var id_kecamatan = $('#kecamatan').val();
                    console.log(id_kecamatan);
                    $.ajax({
                        type : "POST",
                        url : "{{route('getDesa')}}",
                        data : {id_kecamatan:id_kecamatan},
                        cache : false,
                        success: function (msg){
                            $('#desa').html(msg);
                        },
                        error: function (data){
                            console.log('error:',data);
                        }
                    })
                })
                $('#desa').on('change',function (){
                    var id_desa = $('#desa').val();
                    console.log(id_desa);
                })
                $("#form").submit(function (e) {
                    e.preventDefault();
                    var id_user = $('#user').val();
                    var email = $('#email').val();
                    var ppn = $('#ppn').prop('checked') === true ? 1 : 0;
                    var id_layanan = $('#layanan').val();
                    var id_bts = $('#bts').val();
                    var id_turunan = $('#turunan').val();
                    var ip = $('#ip').val();
                    var ip_radio = $('#ip_radio').val();
                    var id_provinsi = $('#provinsi').val();
                    var id_kabupaten = $('#kabupaten').val();
                    var id_kecamatan = $('#kecamatan').val();
                    var id_desa = $('#desa').val();
                    var id_alamat = $('#alamat').val();
                    var lokasi = $('#lokasi').val();
                    var rt = $('#rt').val();
                    var rw = $('#rw').val();
                    console.log(id_alamat);
                    $.ajax({
                        type: "POST",
                        url: "{{route('admin.postapprove')}}",
                        data: {
                            id_user: id_user,
                            email: email,
                            ppn: ppn,
                            layanan: id_layanan,
                            bts: id_bts,
                            id_turunan: id_turunan,
                            ip: ip,
                            ip_radio: ip_radio,
                            provinsi: id_provinsi,
                            kabupaten: id_kabupaten,
                            kecamatan: id_kecamatan,
                            desa: id_desa,
                            id_alamat: id_alamat,
                            lokasi: lokasi,
                            rt: rt,
                            rw: rw,
                        },
                        cache: false,
                        success: function (data) {
                            if (data.status === 0){
                                alert(data.msg);
                            }else if (data.status === 1){
                                alert(data.msg);
                            }else if (data.status === 2){
                                alert(data.msg);
                            }else if (data.status === 3){
                                alert(data.msg);
                            }else if (data.status === 4){
                                alert(data.msg);
                            }else if (data.status === 5){
                                alert(data.msg);
                            }else if (data.status === 6){
                                alert(data.msg);
                            }else {
                                console.log('success: ' + data);
                                var url = "{{ route('admin.pelangganaktif', ":id") }}";
                                url = url.replace(':id', data);
                                window.location.href = url;
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
