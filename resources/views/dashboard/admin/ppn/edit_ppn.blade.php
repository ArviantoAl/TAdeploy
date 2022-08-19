@extends('layouts.nowa',[
    'titlePage' => __('Edit PPN'),
])

@section('content')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <span class="main-content-title mg-b-0 mg-b-lg-1">Edit PPN</span>
        </div>
        <div class="justify-content-center mt-2">
            <ol class="breadcrumb">
                <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Data PPN</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit PPN</li>
            </ol>
        </div>
    </div>
    <!-- /breadcrumb -->

    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
        <div class="card  box-shadow-0 ">
            <div class="card-header">
                <h4 class="card-title mb-1">Form Edit PPN</h4>
                <p class="mb-2">Ubah data baru untuk data PPN tersebut.</p>
            </div>
            <div class="card-body pt-0">
                <form method="POST" action="{{ route('admin.posteditppn', $ppn->id_ppn) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="tahun" class="form-label">Tahun</label>
                        <input class="form-control" id="tahun" name="tahun" value="{{ $ppn->tahun }}" placeholder="Masukkan Tahun PPN (ex. 2021)" type="number" required autocomplete="tahun" autofocus>
                    </div>
                    <div class="form-group">
                        <label for="jumlah" class="form-label">Jumlah PPN</label>
                        <input class="form-control" id="jumlah" name="jumlah" value="{{ $ppn->jumlah }}" placeholder="Masukkan Jumlah PPN (ex. 11)" type="number" step=any required autocomplete="jumlah" autofocus>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3 mb-0">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
