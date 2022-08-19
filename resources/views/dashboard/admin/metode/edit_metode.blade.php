@extends('layouts.nowa',[
    'titlePage' => __('Edit Metode Pembayaran'),
])

@section('content')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <span class="main-content-title mg-b-0 mg-b-lg-1">Edit Metode Pembayaran</span>
        </div>
        <div class="justify-content-center mt-2">
            <ol class="breadcrumb">
                <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Data Metode Pembayaran</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Metode Pembayaran</li>
            </ol>
        </div>
    </div>
    <!-- /breadcrumb -->

    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
        <div class="card  box-shadow-0 ">
            <div class="card-header">
                <h4 class="card-title mb-1">Form Edit Metode Pembayaran</h4>
                <p class="mb-2">Ubah data baru untuk data Metode Pembayaran tersebut.</p>
            </div>
            <div class="card-body pt-0">
                <form method="POST" action="{{ route('admin.posteditmetode', $metode->id_metode) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="n_metode" class="form-label">Metode Pembayaran</label>
                        <input class="form-control" id="n_metode" name="n_metode" value="{{ $metode->nama_metode }}" placeholder="Masukkan Metode Pembayaran" type="text" required autocomplete="n_metode" autofocus>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3 mb-0">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
