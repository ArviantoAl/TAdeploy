@extends('layouts.nowa',[
    'titlePage' => __('Tambah Lokasi'),
])

@section('content')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <span class="main-content-title mg-b-0 mg-b-lg-1">Tambah Lokasi</span>
        </div>
        <div class="justify-content-center mt-2">
            <ol class="breadcrumb">
                <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Data Lokasi</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah Lokasi</li>
            </ol>
        </div>
    </div>
    <!-- /breadcrumb -->

    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
        <div class="card  box-shadow-0 ">
            <div class="card-header">
                <h4 class="card-title mb-1">Form Tambah Lokasi</h4>
                <p class="mb-2">Isi data form berikut untuk menambahkan Lokasi.</p>
            </div>
            <div class="card-body pt-0">
                <form id="form1" action="{{ route('teknisi.postlokasi') }}">
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="nama" class="form-label">Nama Perangkat</label>
                            <input class="form-control" id="nama" name="nama" placeholder="Masukkan Nama Perangkat" type="text" required autocomplete="nama" autofocus>
                        </div>
                        <div class="form-group col-6">
                            <label for="koordinat" class="form-label">Koordinat Lokasi</label>
                            <input class="form-control" id="koordinat" name="koordinat" placeholder="ex. -7.551311,110.854192" type="text" required autocomplete="koordinat" autofocus>
                        </div>
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
                    <button type="submit" class="btn btn-primary mt-3 mb-0">Create</button>
                </form>
            </div>
        </div>
    </div>

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
// lokasi
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
                $("#form1").submit(function (e) {
                    e.preventDefault();
                    var nama = $('#nama').val();
                    var koordinat = $('#koordinat').val();
                    var id_provinsi = $('#provinsi').val();
                    var id_kabupaten = $('#kabupaten').val();
                    var id_kecamatan = $('#kecamatan').val();
                    var id_desa = $('#desa').val();
                    $.ajax({
                        type: "POST",
                        url: "{{route('admin.postlokasi')}}",
                        data: {
                            nama: nama,
                            koordinat: koordinat,
                            provinsi: id_provinsi,
                            kabupaten: id_kabupaten,
                            kecamatan: id_kecamatan,
                            desa: id_desa,
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
                            }else {
                                // console.log('success: ' + data);
                                window.location.href = "{{route('teknisi.lokasi')}}";
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
