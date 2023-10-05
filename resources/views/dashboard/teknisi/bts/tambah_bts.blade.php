@extends('layouts.nowa',[
    'titlePage' => __('Teknisi Tambah Perangkat BTS'),
])

@section('content')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <span class="main-content-title mg-b-0 mg-b-lg-1">Tambah Perangkat BTS teknisi</span>
        </div>
        <div class="justify-content-center mt-2">
            <ol class="breadcrumb">
                <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Data Perangkat BTS teknisi</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah Perangkat BTS teknisi</li>
            </ol>
        </div>
    </div>
    <!-- /breadcrumb -->

    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
        <div class="card  box-shadow-0 ">
            <div class="card-header">
                <h4 class="card-title mb-1">Form Tambah Perangkat BTS teknisi</h4>
                <p class="mb-2">Isi data form berikut untuk menambahkan Perangkat BTS.</p>
            </div>
            <div class="card-body pt-0">
                @if (session()->has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ session()->get('error') }}</strong>
                        <button aria-label="Close" class="btn-close" data-bs-dismiss="alert" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                @endif
                <form method="POST" action="{{ route('teknisi.posttambahbts') }}">
                    @csrf
                    @method('GET')
                    {{-- @if ($item1->name = 0)
                        <div class="form-group">
                            <label for="nama" class="form-label">Nama Perangkat</label>
                            <input class="form-control" id="nama" name="nama" placeholder="Masukkan Nama Perangkat" type="text" required autocomplete="nama" autofocus>
                        </div> 
                    @else --}}
                        <div class="form-group">
                            <label for="nama" class="form-label">Nama Perangkat</label>
                            <input class="form-control" id="nama" value="{{ $item1 ['name'] ?? '' }}" name="nama" placeholder="Masukkan Nama Perangkat" type="text" required autocomplete="nama" autofocus>
                        </div>
                    {{-- @endif --}}
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="lokasi" class="form-label">Lokasi BTS</label>
                            <select name="lokasi" id="lokasi" class="form-control form-select select2" data-bs-placeholder="Pilih Lokasi BTS" required>
                                <option value="0">Pilih Lokasi BTS</option>
                                @foreach ($lokasis as $l)
                                    <option value="{{ $l->id_master }}">{{ $l->nama_master }}-{{ $l->nama_lokasi }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-6">
                            <label for="jenis" class="form-label">Jenis BTS</label>
                            <select name="jenis" id="jenis" class="form-control form-select select2" data-bs-placeholder="Pilih Jenis BTS" required>
                                <option value="0">Pilih Jenis BTS</option>
                                @foreach ($jeniss as $j)
                                    <option value="{{ $j->id_jenis}}">{{ $j->nama_perangkat }}</option>
                                @endforeach
                            </select>
                            {{-- <input class="form-control" id="jenis" name="jenis" placeholder="Masukkan jenis" type="text" required autocomplete="jenis" autofocus value="{{ $jeniss->id_jenis=3 }}">{{ $jeniss->nama_perangkat }}> --}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="k_frekuensi" class="form-label">Kategori Frekuensi BTS</label>
                            <select name="k_frekuensi" id="k_frekuensi" class="form-control form-select select2" data-bs-placeholder="Pilih Kategori Frekuensi BTS" required>
                                <option value="0">Pilih Kategori Frekuensi BTS</option>
                                @foreach ($kategoris as $k)
                                    <option value="{{ $k->id_kategori }}">{{ $k->kategori_frekuensi }}</option>
                                @endforeach
                            </select>
                        </div>
                        {{-- @if ($item1->frequency = 0)
                            <div class="form-group">
                                <label for="frekuensi" class="form-label">frekuensi</label>
                                <input class="form-control" id="frekuensi" name="frekuensi" placeholder="Masukkan frekuensi Perangkat" type="text" required autocomplete="frekuensi" autofocus>
                            </div> 
                        @else --}}
                        <div class="form-group col-6">
                            <label for="frekuensi" class="form-label">Frekuensi</label>
                            <input class="form-control" id="frekuensi" value="{{ $item3 ['frequency'] ?? '' }}"  name="frekuensi" placeholder="Masukkan Frekuensi" type="number" required autocomplete="frekuensi" autofocus>
                        </div>
                        {{-- @endif --}}
                    </div>
                    <div class="row">
                        {{-- @if ($item1->ssid = 0)
                            <div class="form-group">
                                <label for="ssid" class="form-label">SSID</label>
                                <input class="form-control" id="ssid" name="ssid" placeholder="Masukkan ssid Perangkat" type="text" required autocomplete="ssid" autofocus>
                            </div> 
                        @else --}}
                            <div class="form-group col-6">
                                <label for="ssid" class="form-label">SSID</label>
                                <input class="form-control" id="ssid" value="{{ $item3 ['ssid'] ?? '' }}" name="ssid" placeholder="Masukkan SSID" type="text" required autocomplete="ssid" autofocus>
                            </div>    
                        {{-- @endif --}}
                        
                            <div class="form-group">
                                <label for="ip" class="form-label">IP Address</label>
                                <input class="form-control" id="ip" value="{{ $item2 ['address'] ?? ''}}" name="ip"  type="text" required autocomplete="ip" autofocus>
                            </div>    
                        
                    </div>
                    {{-- {{ dd($response) }} --}}
                    <button type="submit" class="btn btn-primary mt-3 mb-0">Create</button>
                </form>
            </div>
        </div>
    </div>
@endsection
