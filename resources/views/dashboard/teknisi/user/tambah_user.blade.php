@extends('layouts.nowa',[
    'titlePage' => __('Tambah User'),
])

@section('content')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <span class="main-content-title mg-b-0 mg-b-lg-1">Tambah User</span>
        </div>
        <div class="justify-content-center mt-2">
            <ol class="breadcrumb">
                <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Data User</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah User</li>
            </ol>
        </div>
    </div>
    <!-- /breadcrumb -->

    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
        <div class="card  box-shadow-0 ">
            <div class="card-header">
                <h4 class="card-title mb-1">Form Tambah User</h4>
                <p class="mb-2">Isi data form berikut untuk menambahkan akun user.</p>
            </div>
            <div class="card-body pt-0">
                <form method="POST" action="{{ route('admin.postuser') }}">
                    @csrf
{{--                    <div class="">--}}
                        <div class="form-group">
                            <label for="user_role" class="form-label">{{ __('User Role') }}</label>
                            <select id="user_role" name="user_role" class="form-control form-select select2" data-bs-placeholder="Pilih User Role">
                                <option>Pilih User Role</option>
                                @foreach ($roles as $jenis)
                                    <option value="{{ $jenis->id_role }}">{{ $jenis->nama_role }}</option>
                                @endforeach
                            </select>
                        </div>
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
                                <input class="form-control" id="username" name="username" placeholder="Masukkan Username" type="text" required autocomplete="username" autofocus>
                            </div>
                        </div>
{{--                    </div>--}}
                    <button type="submit" class="btn btn-primary mt-3 mb-0">Create</button>
                </form>
            </div>
        </div>
    </div>
@endsection
