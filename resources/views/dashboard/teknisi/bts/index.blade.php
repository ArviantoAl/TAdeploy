@extends('layouts.nowa',[
    'titlePage' => __('Daftar Perangkat BTS'),
])

@section('content')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <span class="main-content-title mg-b-0 mg-b-lg-1">Daftar Perangkat BTS</span>
        </div>
        <div class="justify-content-center mt-2">
            <ol class="breadcrumb">
                <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Data Perangkat BTS</a></li>
                <li class="breadcrumb-item active" aria-current="page">Daftar Perangkat BTS</li>
            </ol>
        </div>
    </div>
    <!-- /breadcrumb -->

    <!-- Row -->
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="btn-group ms-2 mt-2 mb-2">
                <a class="btn btn-success" href="{{route('teknisi.tambahbts')}}">
                    Tambah Perangkat BTS
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
                                <th>Nama Perangkat</th>
                                <th>BTS</th>
                                <th>Kategori Frekuensi</th>
                                <th>Jenis</th>
                                <th>Frekuensi</th>
                                <th>SSID</th>
                                <th>IP</th>
                                <th>Status</th>
                                <th colspan="2">Action</th>
                            </tr>
                            </thead>
                            <tbody style="text-align: center">
                            @foreach ($btss as $no => $bts)
                                <tr>
                                    <td>{{ $no+1 }}</td>
                                    <td>{{ $bts->nama_bts }}</td>
                                    <td>{{ $bts->lokasi->nama_master }}</td>
                                    <td>{{ $bts->kategori->kategori_frekuensi }}</td>
                                    <td>{{ $bts->jenis->nama_perangkat }}</td>
                                    <td>{{ $bts->frekuensi }}</td>
                                    <td>{{ $bts->ssid }}</td>
                                    <td>{{ $bts->ip }}</td>
                                    @if($bts->status_id == 3)
                                        <td>
                                            <h5>
                                                <span class="badge badge-pill bg-success me-1">{{ $bts->status->nama_status }}</span>
                                            </h5>
                                        </td>
                                        <td>
                                            <a class="btn btn-warning" href="{{ route('admin.editbts', $bts->id_bts) }}" data-toggle="tooltip" title="Edit">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        </td><td>
                                            <a class="btn btn-danger" href="{{ route('admin.nonaktifbts', $bts->id_bts) }}" data-toggle="tooltip" title="Nonaktif">
                                                <i class="fa fa-ban"></i>
                                            </a>
                                        </td>
                                    @elseif($bts->status_id == 4)
                                        <td>
                                            <h5>
                                                <span class="badge badge-pill bg-danger me-1">{{ $bts->status->nama_status }}</span>
                                            </h5>
                                        </td>
                                        <td>
                                            <a class="btn btn-success" href="{{ route('admin.aktifbts', $bts->id_bts) }}" data-toggle="tooltip" title="Aktifkan">
                                                <i class="fa fa-check"></i>
                                            </a>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $btss->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
