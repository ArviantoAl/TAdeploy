@extends('layouts.nowa',[
    'titlePage' => __('Daftar Lokasi'),
])

@section('content')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <span class="main-content-title mg-b-0 mg-b-lg-1">Daftar Lokasi</span>
        </div>
        <div class="justify-content-center mt-2">
            <ol class="breadcrumb">
                <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Data Lokasi</a></li>
                <li class="breadcrumb-item active" aria-current="page">Daftar Lokasi</li>
            </ol>
        </div>
    </div>
    <!-- /breadcrumb -->

    <!-- Row -->
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="btn-group ms-2 mt-2 mb-2">
                <a class="btn btn-success" href="{{route('admin.tambahlokasi')}}">
                    Tambah Lokasi
                </a>
            </div>
            <div class="card custom-card overflow-hidden">
                <div class="card-body">
                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ session()->get('success') }}</strong>
                            <button aria-label="Close" class="btn-close" data-bs-dismiss="alert" type="button"><span aria-hidden="true">&times;</span></button>
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped mg-b-0 text-md-nowrap">
                            <thead style="text-align: center">
                            <tr>
                                <th>No</th>
                                <th>Nama BTS</th>
                                <th>Lokasi Pemasangan</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody style="text-align: center">
                            @foreach ($lokasis as $no => $lokasi)
                                <tr>
                                    <td>{{ $no+1 }}</td>
                                    <td>{{ $lokasi->nama_master }}</td>
                                    <td>{{ $lokasi->nama_lokasi }}</td>
                                    <td>
                                        <a class="btn btn-warning" href="{{ route('admin.editlokasi', $lokasi->id_master) }}" data-toggle="tooltip" title="Edit">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $lokasis->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
