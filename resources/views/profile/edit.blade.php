@extends('layouts.nowa',[
    'titlePage' => __('Edit Profil'),
])

@section('content')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <span class="main-content-title mg-b-0 mg-b-lg-1">Edit Profil</span>
        </div>
        <div class="justify-content-center mt-2">
            <ol class="breadcrumb">
                <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Profil</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Profil</li>
            </ol>
        </div>
    </div>
    <!-- /breadcrumb -->

    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
        <div class="card  box-shadow-0 ">
            <div class="card-header">
                <h4 class="card-title mb-1">Form Edit Profil</h4>
                <p class="mb-2">Ubah data profil anda.</p>
            </div>
            <div class="card-body pt-0">
                @if (session()->has('message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session()->get('message') }}</strong>
                        <button aria-label="Close" class="btn-close" data-bs-dismiss="alert" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                @endif

                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('PUT')
                    {{--                    <div class="">--}}

                    <div class="form-group">
                        <label for="name" class="form-label">Nama</label>
                        <input class="form-control" id="name" name="name" value="{{ old('name', auth()->user()->name) }}" placeholder="Masukkan Nama Lengkap" type="text" required autocomplete="name" autofocus>
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="email" class="form-label">Email</label>
                            <input class="form-control" id="email" name="email" value="{{ old('email', auth()->user()->email) }}" placeholder="Masukkan Email" type="email" required autocomplete="email" autofocus>
                        </div>
                        <div class="form-group col-6">
                            <label for="username" class="form-label">Username</label>
                            <input class="form-control" id="username" name="username" value="{{ old('username', auth()->user()->username) }}" placeholder="Masukkan Username" type="text" required autocomplete="username" autofocus>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="no_hp" class="form-label">No HP</label>
                        <input class="form-control" id="no_hp" name="no_hp" value="{{ old('no_hp', auth()->user()->no_hp) }}" placeholder="Masukkan Nomor HP" type="text" required autocomplete="no_hp" autofocus>
                    </div>
                    {{--                    </div>--}}
                    <button type="submit" class="btn btn-primary mt-3 mb-0">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
