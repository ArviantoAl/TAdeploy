@extends('layouts.nowa',[
    'titlePage' => __('Ubah Sandi'),
])

@section('content')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <span class="main-content-title mg-b-0 mg-b-lg-1">Ubah Sandi</span>
        </div>
        <div class="justify-content-center mt-2">
            <ol class="breadcrumb">
                <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Profil</a></li>
                <li class="breadcrumb-item active" aria-current="page">Ubah Sandi</li>
            </ol>
        </div>
    </div>
    <!-- /breadcrumb -->

    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
        <div class="card  box-shadow-0 ">
            <div class="card-header">
                <h4 class="card-title mb-1">Form Ubah Sandi</h4>
                <p class="mb-2">Ubah kata sandi akun anda.</p>
            </div>
            <div class="card-body pt-0">
                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session()->get('success') }}</strong>
                        <button aria-label="Close" class="btn-close" data-bs-dismiss="alert" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                @endif
                @if (session()->has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ session()->get('error') }}</strong>
                        <button aria-label="Close" class="btn-close" data-bs-dismiss="alert" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                @endif

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    {{--                    <div class="">--}}

                    <div class="form-group">
                        <label for="current_password" class="form-label">Kata sandi saat ini</label>
                        <input class="form-control" id="current_password" name="current_password" placeholder="Masukkan Kata Sandi Saat Ini" type="password" required autocomplete="current_password" autofocus>
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="new_password" class="form-label">Kata sandi baru</label>
                            <input class="form-control @error('password') is-invalid @enderror" id="new_password" name="password" placeholder="Masukkan Kata Sandi Baru" type="password" required autocomplete="password" autofocus>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group col-6">
                            <label for="password_confirmation" class="form-label">Konfirmasi Kata sandi baru</label>
                            <input class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" placeholder="Konfirmasi Password Baru" type="password" required autocomplete="password_confirmation" autofocus>
                            @error('password_confirmation')
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Konfirmasi Kata sandi baru salah</strong>
                                <button aria-label="Close" class="btn-close" data-bs-dismiss="alert" type="button"><span aria-hidden="true">&times;</span></button>
                            </div>
                            @enderror
                        </div>
                    </div>

                    {{--                    </div>--}}
                    <button type="submit" class="btn btn-primary mt-3 mb-0">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
