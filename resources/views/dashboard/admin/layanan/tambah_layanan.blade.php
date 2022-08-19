@extends('layouts.nowa',[
    'titlePage' => __('Tambah Layanan'),
])

@section('content')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <span class="main-content-title mg-b-0 mg-b-lg-1">Tambah Layanan</span>
        </div>
        <div class="justify-content-center mt-2">
            <ol class="breadcrumb">
                <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Data User</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah Layanan</li>
            </ol>
        </div>
    </div>
    <!-- /breadcrumb -->

    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
        <div class="card  box-shadow-0 ">
            <div class="card-header">
                <h4 class="card-title mb-1">Form Tambah Layanan</h4>
                <p class="mb-2">Isi data form berikut untuk menambahkan Layanan.</p>
            </div>
            <div class="card-body pt-0">
                <form method="POST" action="{{ route('admin.postlayanan') }}">
                    @csrf
                    {{--                    <div class="">--}}
                    <div class="form-group">
                        <label for="nama_layanan" class="form-label">Nama Layanan</label>
                        <input class="form-control" id="nama_layanan" name="nama_layanan" placeholder="Masukkan Nama Layanan" type="text" required autocomplete="nama_layanan" autofocus>
                    </div>
                    <div class="form-group">
                        <label for="harga" class="form-label">Harga</label>
                        <input class="form-control" id="harga" name="harga" placeholder="Masukkan Harga (ex. 100000)" type="number" required autocomplete="harga" autofocus>
                    </div>
                    {{--                    </div>--}}
                    <button type="submit" class="btn btn-primary mt-3 mb-0">Create</button>
                </form>
            </div>
        </div>
    </div>
@endsection
