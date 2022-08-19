@extends('layouts.app',[
    'titlePage'=>__('Register')
])

@section('content')
    <section class="section">
        <div class="container mt-5">
            <div class="row">
                <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
                    <div class="login-brand">
                        <img src="{{ asset('assets') }}/img/stisla-fill.svg" alt="logo" width="100" class="shadow-light rounded-circle">
                    </div>

                    <div class="card card-primary">
                        <div class="card-header"><h4>{{ __('Register') }}</h4></div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf

                                <div class="form-group">
                                    <label for="name">{{ __('Name') }}</label>
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                        @error('name')
                                        <div class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                        @enderror
                                </div>

                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="email">{{ __('Email Address') }}</label>
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                        @error('email')
                                        <div class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="username">{{ __('Username') }}</label>
                                        <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                                        @error('username')
                                        <div class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="no_hp">{{ __('Nomor HP') }}</label>
                                    <input id="no_hp" type="text" class="form-control @error('no_hp') is-invalid @enderror" name="no_hp" value="{{ old('no_hp') }}" required autocomplete="no_hp" autofocus>

                                    @error('no_hp')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="password" class="d-block">{{ __('Password') }}</label>
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                        @error('password')
                                        <div class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="password2" class="d-block">{{ __('Confirm Password') }}</label>
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div>

                                <div class="form-divider">
                                    {{ __('Data Alamat') }}
                                </div>
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="provinsi">{{ __('Provinsi') }}</label>
                                        <select class="form-control selectric" id="provinsi" name="id_provinsi">
                                            <option>Pilih Provinsi</option>
                                            @foreach ($provincies as $provinsi)
                                                <option value="{{ $provinsi->id }}">{{ $provinsi->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="kabupaten">{{ __('Kabupaten/Kota') }}</label>
                                        <select class="form-control selectric" id="kabupaten" name="id_kabupaten"></select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="kabupaten">{{ __('Kecamatan') }}</label>
                                        <select class="form-control selectric" id="kecamatan" name="id_kecamatan"></select>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="kabupaten">{{ __('Kelurahan/Desa') }}</label>
                                        <select class="form-control selectric" id="desa" name="id_desa"></select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="alamat">{{ __('Alamat Lengkap') }}</label>
                                    <textarea id="alamat" class="form-control @error('alamat') is-invalid @enderror" name="alamat" required autocomplete="alamat" autofocus></textarea>

                                    @error('alamat')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" name="agree" class="custom-control-input" id="agree">
                                        <label class="custom-control-label" for="agree">I agree with the terms and conditions</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                                        Register
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="simple-footer">
                        Copyright &copy; Stisla 2018
                    </div>
                </div>
            </div>
        </div>
    </section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(function(){
           $.ajaxSetup({
              headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
           });

           $(function (){
               $('#provinsi').on('change',function (){
                   let id_provinsi = $('#provinsi').val();

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
                   let id_kabupaten = $('#kabupaten').val();

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
                   let id_kecamatan = $('#kecamatan').val();

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
                   let id_desa = $('#desa').val();
               })
           })
        });
    </script>
@endsection
