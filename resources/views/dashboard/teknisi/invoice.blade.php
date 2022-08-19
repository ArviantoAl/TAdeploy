@extends('layouts.app',[
    'titlePage' => __('Daftar Invoice'),
    'sub' => $header
])

@section('content')
    <div class="row justify-content-center">
        <div class="col-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{ $header }}</h4>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        @if(count($invoices)==0)
                            <p>Tidak ada data</p>
                        @elseif(count($invoices)>0)
                            <table class="table">
                                <thead>
                                <th>Id Invoice</th>
                                <th>Nama Pelanggan</th>
                                <th>Tanggal Terbit</th>
                                <th>Tanggal Tempo</th>
                                <th>Harga Bayar</th>
                                <th>Status</th>
                                <th>Action</th>
                                </thead>
                                <tbody>
                                @foreach ($invoices as $no => $invoice)
                                    <tr>
                                        <td>{{ $invoice->id_invoice }}</td>
                                        <td>{{ $invoice->pelanggan->name }}</td>
                                        <td>{{ $invoice->tgl_terbit }}</td>
                                        <td>{{ $invoice->tgl_tempo }}</td>
                                        <td>{{ $invoice->harga_bayar }}</td>
                                        @if($invoice->status == 0)
                                            <td><div class="badge badge-info">Belum Dikirim</div></td>
                                            <td>
                                                <a class="btn btn-success" href="{{ route('teknisi.kiriminvoice', $invoice->id_invoice) }}">Kirim Invoice</a>
                                            </td>
                                        @elseif($invoice->status == 1)
                                            @if($tanggal>=$invoice->tgl_tempo)
                                                <td><div class="badge badge-warning">Melebihi Batas Pembayaran</div></td>
                                                <td>
                                                    <a class="btn btn-danger" href="{{ route('teknisi.tolakpembayaran', $invoice->id_invoice) }}">Tolak</a>
                                                </td>
                                            @elseif($tanggal<=$invoice->tgl_tempo)
                                                <td><div class="badge badge-warning">Menunggu Pembayaran</div></td>
                                                <td>
                                                    <a class="btn btn-success" href="{{ route('teknisi.approvepembayaran', $invoice->id_invoice) }}">Invoice Terbayar</a>

                                                    <a class="btn btn-danger" href="{{ route('teknisi.tolakpembayaran', $invoice->id_invoice) }}">Tolak</a>
                                                </td>
                                            @endif
                                        @elseif($invoice->status == 2)
                                            <td><div class="badge badge-success">Lunas</div></td>
                                        @elseif($invoice->status == 3)
                                            <td><div class="badge badge-danger">Tidak Dibayar</div></td>
                                        @endif
                                        <td>
                                            <a class="btn btn-success" href="{{ route('teknisi.printinv', $invoice->id_invoice) }}">Cetak</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
