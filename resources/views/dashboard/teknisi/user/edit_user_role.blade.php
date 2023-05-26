@extends('layouts.nowa', [
    'titlePage' => __('Edit User'),
])

@section('content')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <span class="main-content-title mg-b-0 mg-b-lg-1">Edit User</span>
        </div>
        <div class="justify-content-center mt-2">
            <ol class="breadcrumb">
                <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Data User</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit User</li>
            </ol>
        </div>
    </div>
    <!-- /breadcrumb -->

    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
        <div class="card  box-shadow-0 ">
            <div class="card-header">
                <h4 class="card-title mb-1">Form Edit User</h4>
                <p class="mb-2">Ubah data baru untuk data user tersebut.</p>
            </div>
            <div class="card-body pt-0">
                <form method="POST" action="{{ url('admin/user/' . $user->id_user . '/update-role') }}">
                    @csrf
                    @method('PUT')
                    {{--                    <div class=""> --}}
                    <div class="form-group">
                        <label for="name" class="form-label">Nama</label>
                        <input class="form-control" id="name" name="name" value="{{ $user->name }}"
                            placeholder="Masukkan Nama Lengkap" type="text" required autocomplete="name" autofocus
                            readonly>
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="email" class="form-label">Role</label>
                            <select name="role" id="">
                                <option value="1">Admin</option>
                                <option value="2">Teknisi</option>
                                <option value="3">Pelanggan</option>
                                <option value="4">Keuangan</option>
                            </select>
                        </div>
                    </div>
                    {{--                    </div> --}}
                    <button type="submit" class="btn btn-primary mt-3 mb-0">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
