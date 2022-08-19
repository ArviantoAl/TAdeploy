@extends('layouts.nowa',[
    'titlePage' => __('Daftar Invoice'),
])

@section('content')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <span class="main-content-title mg-b-0 mg-b-lg-1">Daftar Invoice</span>
        </div>
        <div class="justify-content-center mt-2">
            <ol class="breadcrumb">
                <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Data Invoice</a></li>
                <li class="breadcrumb-item active" aria-current="page">Daftar Invoice</li>
            </ol>
        </div>
    </div>
    <!-- /breadcrumb -->

    <!-- Row -->
    <div class="row row-sm">
        <div class="col-lg-12">
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
                                <th>Id Invoice</th>
                                <th>Tanggal Terbit</th>
                                <th>Tanggal Tempo</th>
                                <th>Total Tagihan</th>
                                <th>Status Terakhir</th>
                                <th colspan="2">Action</th>
                            </tr>
                            </thead>
                            <tbody style="text-align: center">
                            @foreach ($invoices as $no => $invoice)
                                <tr>
                                    <td>{{ $invoice->id_invoice }}</td>
                                    <td>{{ $invoice->tgl_terbit }}</td>
                                    <td>{{ $invoice->tgl_tempo }}</td>
                                    <td>{{ rupiah($invoice->harga_bayar) }}</td>
                                    @if($invoice->status_id == 6)
                                        <td>
                                            <h5><span class="badge badge-pill bg-warning me-1">{{ $invoice->status->nama_status }}</span></h5>
                                        </td>
                                        <td>
                                            <a class="btn btn-warning" data-bs-toggle="collapse" data-bs-target="#demo{{$invoice->id_invoice}}" data-toggle="tooltip" title="Upload Bukti Pembayaran">
                                                <i style="color: white" class="fa fa-upload"></i>
                                            </a>
                                        </td>
                                    @elseif($invoice->status_id == 7)
                                        <td>
                                            <h5><span class="badge badge-pill bg-warning me-1">{{ $invoice->status->nama_status }}</span></h5>
                                        </td>
                                        <td>
                                            <a class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#myModal{{$invoice->id_invoice}}" data-toggle="tooltip" title="Lihat Bukti Bayar">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                        </td>
                                    @elseif($invoice->status_id == 8)
                                        <td>
                                            <h5><span class="badge badge-pill bg-success me-1">{{ $invoice->status->nama_status }}</span></h5>
                                        </td>
                                    @elseif($invoice->status_id == 9)
                                        <td>
                                            <h5><span class="badge badge-pill bg-danger me-1">{{ $invoice->status->nama_status }}</span></h5>
                                        </td>
                                        <td>
                                            <a class="btn btn-success" href="{{ route('pelanggan.klaim', $invoice->id_invoice) }}" data-toggle="tooltip" title="Ajukan Klaim">
                                                <i class="fa fa-paper-plane"></i>
                                            </a>
                                        </td>
                                    @elseif($invoice->status_id == 11)
                                        <td>
                                            <h5><span class="badge badge-pill bg-success me-1">{{ $invoice->status->nama_status }}</span></h5>
                                        </td>
                                    @endif
                                    <td>
                                        <a class="btn btn-success" href="{{ route('pelanggan.printinv', $invoice->id_invoice) }}" data-toggle="tooltip" title="Cetak">
                                            <i class="fa fa-print"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr id="demo{{$invoice->id_invoice}}" class="collapse">
                                    <td colspan="7">
                                        <form method="POST" action="{{ route('pelanggan.bukti', $invoice->id_invoice) }}" enctype="multipart/form-data">
                                            @csrf

                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="metode" class="form-label">Metode Pembayaran</label>
                                                        <select name="metode" id="metode" class="form-control form-select select2" data-bs-placeholder="Pilih Metode Pembayaran">
                                                            <option value="0">Pilih Metode Pembayaran</option>
                                                            @foreach ($metodes as $m)
                                                                <option value="{{ $m->id_metode }}" {{ $m->id_metode == 1 ? 'disabled' : '' }}>{{ $m->nama_metode }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="bank" class="form-label">Bank</label>
                                                        <select name="bank" id="bank" class="form-control form-select select2" data-bs-placeholder="Pilih Bank">
                                                            <option value="0">Pilih Bank</option>
                                                            @foreach ($banks as $b)
                                                                <option value="{{ $b->id_bank }}">{{ $b->nama_bank }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group col-6">
                                                    <label for="bukti" class="form-label">Upload Bukti</label>
                                                    <input id="bukti" type="file" class="dropify" name="bukti" data-height="100" required/>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="ket" class="form-label">Keterangan</label>
                                                <textarea class="form-control" id="ket" placeholder="Masukkan Keterangan Jika dibutuhkan"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary btn-lg btn-center-block col-sm-3">
                                                    Upload
                                                </button>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $invoices->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('modal')
    @foreach($invoices as $no => $invoice)
        <div class="modal" id="myModal{{$invoice->id_invoice}}">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Bukti pembayaran: {{$invoice->id_invoice}}</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        @if($invoice->bukti_bayar != null)
                            <p>Metode Pembayaran: {{$invoice->metode->nama_metode}}</p>
                            <p>Kategori Bank: {{$invoice->bank->nama_bank}}</p>
                            <img src="{{ asset('bukti_bayar') }}/{{ $invoice->bukti_bayar }}" width="100%">
                        @endif
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div>
    @endforeach
@endsection
