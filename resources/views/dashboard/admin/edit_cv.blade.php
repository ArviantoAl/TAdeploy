@extends('layouts.nowa',[
    'titlePage' => __('Edit Profil CV'),
])

@section('content')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <span class="main-content-title mg-b-0 mg-b-lg-1">Edit Profil CV</span>
        </div>
        <div class="justify-content-center mt-2">
            <ol class="breadcrumb">
                <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Data Profil CV</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Profil CV</li>
            </ol>
        </div>
    </div>
    <!-- /breadcrumb -->

    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
        <div class="card  box-shadow-0 ">
            <div class="card-header">
                <h4 class="card-title mb-1">Form Edit Profil CV</h4>
                <p class="mb-2">Ubah data baru untuk data Profil CV.</p>
            </div>
            <div class="card-body pt-0">
                <form id="form" method="POST" action="{{ route('admin.posteditcv') }}" enctype="multipart/form-data">
                    @csrf
                    <input id="id" value="{{$profil->id_profil}}" type="hidden">
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="nama_cv" class="form-label">Nama CV</label>
                            <input class="form-control" id="nama_cv" name="nama_cv" value="{{ $profil->nama_cv }}" placeholder="Masukkan Nama CV" type="text" required autocomplete="nama_cv" autofocus>
                        </div>
                        <div class="form-group col-6">
                            <label for="no_hp" class="form-label">No Hp</label>
                            <input class="form-control" id="no_hp" name="no_hp" value="{{ $profil->no_hp }}" placeholder="Masukkan No Hp (ex. 081902503960)" type="number" required autocomplete="no_hp" autofocus>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="email_cv" class="form-label">Email CV</label>
                            <input class="form-control" id="email_cv" name="email_cv" value="{{ $profil->email_cv }}" placeholder="Masukkan Email CV" type="email" required autocomplete="email_cv" autofocus>
                        </div>
                        <div class="form-group col-6">
                            <label for="web_cv" class="form-label">Web CV</label>
                            <input class="form-control" id="web_cv" name="web_cv" value="{{ $profil->web_cv }}" placeholder="Masukkan Web CV" type="text" required autocomplete="web_cv" autofocus>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="provinsi" class="form-label">Provinsi</label>
                            <select name="provinsi" id="provinsi" class="form-control form-select select2" data-bs-placeholder="Pilih Provinsi">
                                @foreach ($provinsi as $p)
                                    <option value="{{ $p->id }}" {{ $profil->provinsi_id == $p->id ? 'selected' : '' }}>{{ $p->name }}</option>
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
                            <label for="alamat" class="form-label">Alamat Detail</label>
                            <textarea class="form-control" id="alamat" placeholder="Masukkan Alamat Lengkap CV" required>{{ $profil->detail_alamat }}</textarea>
                        </div>
                        <div class="form-group col-6">
                            <label for="lokasi" class="form-label">Koordinat Lokasi</label>
                            <input class="form-control" id="lokasi" name="lokasi" value="{{ $profil->latitude }},{{ $profil->longitude }}" placeholder="Masukkan koordinat lokasi" type="text" required autocomplete="lokasi" autofocus>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="rt" class="form-label">RT</label>
                            <input class="form-control" id="rt" name="rt" value="{{ $profil->rt }}" placeholder="Masukkan RT (ex. 9)" type="number" required autocomplete="rt" autofocus>
                        </div>
                        <div class="form-group col-6">
                            <label for="rw" class="form-label">RW</label>
                            <input class="form-control" id="rw" name="rw" value="{{ $profil->rw }}" placeholder="Masukkan RW (ex. 9)" type="number" required autocomplete="rw" autofocus>
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
                let idlang = 1;
                let id_provinsi = $('#provinsi').val();
                var urlkab = "{{ route('getKabupatencv', ":id") }}";
                urlkab = urlkab.replace(':id', idlang);
                var urlkec = "{{ route('getKecamatancv', ":id") }}";
                urlkec = urlkec.replace(':id', idlang);
                var urldes = "{{ route('getDesacv', ":id") }}";
                urldes = urldes.replace(':id', idlang);
                $.ajax({
                    type : "POST",
                    url : urlkab,
                    data : {id_provinsi:id_provinsi},
                    cache : false,
                    success: function (msg){
                        $('#kabupaten').html(msg);
                        $('#kecamatan').html('');
                        $('#desa').html('');
                        let id_kabupaten = $('#kabupaten').val();
                        $.ajax({
                            type : "POST",
                            url : urlkec,
                            data : {id_kabupaten:id_kabupaten},
                            cache : false,
                            success: function (msg){
                                $('#kecamatan').html(msg);
                                $('#desa').html('');
                                let id_kecamatan = $('#kecamatan').val();
                                console.log(id_kecamatan);
                                $.ajax({
                                    type : "POST",
                                    url : urldes,
                                    data : {id_kecamatan:id_kecamatan},
                                    cache : false,
                                    success: function (msg){
                                        $('#desa').html(msg);
                                    },
                                    error: function (data){
                                        console.log('error:',data);
                                    }
                                })
                            },
                            error: function (data){
                                console.log('error:',data);
                            }
                        })
                    },
                    error: function (data){
                        console.log('error:',data);
                    },
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
                    var id = $('#id').val();

                    var nama_cv = $('#nama_cv').val();
                    var no_hp = $('#no_hp').val();
                    var email_cv = $('#email_cv').val();
                    var web_cv = $('#web_cv').val();
                    var rt = $('#rt').val();
                    var rw = $('#rw').val();
                    var id_provinsi = $('#provinsi').val();
                    var id_kabupaten = $('#kabupaten').val();
                    var id_kecamatan = $('#kecamatan').val();
                    var id_desa = $('#desa').val();
                    var id_alamat = $('#alamat').val();
                    var lokasi = $('#lokasi').val();
                    $.ajax({
                        type: "POST",
                        url: "{{ route('admin.posteditcv') }}",
                        data: {
                            id: id,
                            nama_cv: nama_cv,
                            no_hp: no_hp,
                            email_cv: email_cv,
                            web_cv: web_cv,
                            rt: rt,
                            rw: rw,
                            id_provinsi: id_provinsi,
                            id_kabupaten: id_kabupaten,
                            id_kecamatan: id_kecamatan,
                            id_desa: id_desa,
                            id_alamat: id_alamat,
                            lokasi: lokasi,
                        },
                        cache: false,
                        success: function (data) {
                            console.log('success: ' + data);
                            window.location.href = "{{route('admin.profilcv')}}";
                        },
                        error: function (data) {
                            var errors = data.responseJSON;
                            console.log(errors);
                        }
                    })
                })
            })
        });
    </script>
@endsection
