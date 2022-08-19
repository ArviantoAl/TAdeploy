@extends('layouts.nowa',[
    'titlePage' => __('Edit Frekuensi'),
])

@section('content')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <span class="main-content-title mg-b-0 mg-b-lg-1">Edit Frekuensi</span>
        </div>
        <div class="justify-content-center mt-2">
            <ol class="breadcrumb">
                <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Data Frekuensi</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Frekuensi</li>
            </ol>
        </div>
    </div>
    <!-- /breadcrumb -->

    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
        <div class="card  box-shadow-0 ">
            <div class="card-header">
                <h4 class="card-title mb-1">Form Edit Frekuensi</h4>
                <p class="mb-2">Ubah data baru untuk data Frekuensi tersebut.</p>
            </div>
            <div class="card-body pt-0">
                <form method="POST" action="{{ route('admin.posteditfrek', $frek->id_kategori) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="kat_frek" class="form-label">Kategori Frekuensi</label>
                        <input class="form-control" id="kat_frek" name="kat_frek" value="{{ $frek->kategori_frekuensi }}" placeholder="Masukkan Kategori Frekuensi (ex. 2,4g)" type="text" required autocomplete="kat_frek" autofocus>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3 mb-0">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
