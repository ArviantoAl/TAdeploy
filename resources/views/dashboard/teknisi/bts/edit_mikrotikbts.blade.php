@extends('layouts.nowa',[
    'titlePage' => __('Edit Perangkat BTS'),
])

@section('content')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <span class="main-content-title mg-b-0 mg-b-lg-1">Edit Perangkat BTS</span>
        </div>
        <div class="justify-content-center mt-2">
            <ol class="breadcrumb">
                <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Data Perangkat BTS</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Perangkat BTS</li>
            </ol>
        </div>
    </div>
    <!-- /breadcrumb -->

    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
        <div class="card  box-shadow-0 ">
            <div class="card-header">
                <h4 class="card-title mb-1">Form Edit Perangkat BTS</h4>
                <p class="mb-2">Isi data form berikut untuk mengubah Perangkat BTS.</p>
            </div>
            <div class="card-body pt-0">
                @if (session()->has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ session()->get('error') }}</strong>
                        <button aria-label="Close" class="btn-close" data-bs-dismiss="alert" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                @endif
                    <form method="POST" action="{{ route('teknisi.posteditloginbts', $bts->id_bts) }}">
                        @csrf
                        @method('POST')
                    <div class="form-group">
                        <label for="nama" class="form-label">Nama Perangkat</label>
                        <input class="form-control" id="nama" name="nama" value="{{ $item1 ['name'] }}" name="nama" placeholder="Masukkan Nama Perangkat" type="text" required autocomplete="nama" autofocus>
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="lokasi" class="form-label">Lokasi BTS</label>
                            <select name="lokasi" id="lokasi" class="form-control form-select select2" data-bs-placeholder="Pilih Lokasi BTS" required>
                                <option value="0">Pilih Lokasi BTS</option>
                                @foreach ($lokasis as $l)
                                    <option value="{{ $l->id_master }}" {{ $bts->lokasi_id == $l->id_master ? 'selected' : '' }}>{{ $l->nama_master }}-{{ $l->nama_lokasi }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-6">
                            <label for="jenis" class="form-label">Jenis BTS</label>
                            <select name="jenis" id="jenis" class="form-control form-select select2" data-bs-placeholder="Pilih Jenis BTS" required>
                                <option value="0">Pilih Lokasi BTS</option>
                                @foreach ($jeniss as $j)
                                    <option value="{{ $j->id_jenis }}" {{ $bts->jenis_id == $j->id_jenis ? 'selected' : '' }}>{{ $j->nama_perangkat }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-4">
                            <label for="k_frekuensi" class="form-label">Kategori Frekuensi BTS</label>
                            <select name="k_frekuensi" id="k_frekuensi" class="form-control form-select select2" data-bs-placeholder="Pilih Kategori Frekuensi BTS" required>
                                <option value="0">Pilih Kategori Frekuensi BTS</option>
                                @foreach ($kategoris as $k)
                                    <option value="{{ $k->id_kategori }}" {{ $bts->kategori_id == $k->id_kategori ? 'selected' : '' }}>{{ $k->kategori_frekuensi }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-4">
                            <label for="frekuensi" class="form-label">Frekuensi</label>
                            <input class="form-control" id="frekuensi" name="frekuensi" value="{{ $item3 ['frequency'] ?? '' }}"  placeholder="Masukkan Frekuensi" type="number" required autocomplete="frekuensi" autofocus>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="ssid" class="form-label">SSID</label>
                            <input class="form-control" id="ssid" name="ssid" value="{{ $item3 ['ssid'] ?? '' }}"  placeholder="Masukkan SSID" type="text" required autocomplete="ssid" autofocus>
                        </div>
                        <div class="form-group col-6">
                            <label for="ip" class="form-label">IP Address</label>
                            <input class="form-control" id="ip" name="ip" value="{{ $item2 ['address'] ?? '' }}"  placeholder="Masukkan IP BTS" type="text" required autocomplete="ip" autofocus>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3 mb-0">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
