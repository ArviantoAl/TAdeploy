@extends('layouts.nowa',[
    'titlePage' => __('Tambah Kategori Bank'),
])

@section('content')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <span class="main-content-title mg-b-0 mg-b-lg-1">Tambah Kategori Bank</span>
        </div>
        <div class="justify-content-center mt-2">
            <ol class="breadcrumb">
                <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Data Kategori Bank</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah Kategori Bank</li>
            </ol>
        </div>
    </div>
    <!-- /breadcrumb -->

    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
        <div class="card  box-shadow-0 ">
            <div class="card-header">
                <h4 class="card-title mb-1">Form Tambah Kategori Bank</h4>
                <p class="mb-2">Isi data form berikut untuk menambahkan Kategori Bank.</p>
            </div>
            <div class="card-body pt-0">
                <form method="POST" action="{{ route('keuangan.postbank') }}">
                    @csrf
                    <div class="form-group">
                        <label for="n_bank" class="form-label">Nama Bank</label>
                        <input class="form-control" id="n_bank" name="n_bank" placeholder="Masukkan Nama Bank" type="text" required autocomplete="n_bank" autofocus>
                    </div>
                    <div class="form-group">
                        <label for="norek" class="form-label">Nomor Rekening</label>
                        <input class="form-control" id="norek" name="norek" placeholder="ex. 375401029446533" type="number" required autocomplete="norek" autofocus>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3 mb-0">Create</button>
                </form>
            </div>
        </div>
    </div>
@endsection
