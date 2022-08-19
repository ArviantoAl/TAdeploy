@extends('layouts.app',[
    'titlePage' => __('Daftar Layanan'),
    'sub' => ' '
])

@section('content')
    <div class="row justify-content-center">
        <div class="col-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>Daftar Layanan</h4>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-md">
                            <thead>
                            <th>No</th>
                            <th>Kategori Layanan</th>
                            <th>Jenis Layanan</th>
                            <th>Harga</th>
                            </thead>
                            <tbody>
                            @foreach ($layanans as $no => $layanan)
                                <tr>
                                    <td>{{ $no+1 }}</td>
                                    <td>{{ $layanan->kategori->nama_kategori }}</td>
                                    <td>{{ $layanan->nama_layanan }}</td>
                                    <td>{{ $layanan->harga }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
