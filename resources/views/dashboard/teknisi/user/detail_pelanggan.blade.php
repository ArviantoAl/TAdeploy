@section('modal')
    @foreach($langganan as $no => $lang)
        <div class="modal" id="myModal{{$lang['id']}}">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Daftar Langganan {{$lang['name']}}</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped mg-b-0 text-md-nowrap">
                                <thead style="text-align: center">
                                <tr>
                                    <th>No</th>
                                    <th>Alamat Pemasangan</th>
                                    <th>Jenis Langganan</th>
                                    <th>IP Adress</th>
                                    <th>Status IP</th>
                                    <th>Tanggal Expired</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody style="text-align: center">
                                @foreach ($lang['langganan'] as $no => $langganan)
                                    <tr>
                                        <td>{{ $no+1 }}</td>
                                        <td>{{ $langganan->alamat_pasang }}</td>
                                        <td>{{ $langganan->layanan->nama_layanan }}</td>
                                        <td>{{ $langganan->ip }}</td>
                                        <td>{{ exec("ping -n 1 " . $langganan->ip, $output, $result)}}</td>
                                        <td>{{ $langganan->tgl_lanjut }}</td>
                                        @if($langganan->status_id == 1)
                                            <td>
                                                <h5>
                                                    <span class="badge badge-pill bg-primary me-1">{{ $langganan->status->nama_status }}</span>
                                                </h5>
                                            </td>
                                        @elseif($langganan->status_id == 2 || $langganan->status_id == 10)
                                            <td>
                                                <h5>
                                                    <span class="badge badge-pill bg-success me-1">Aktif(proses pembayaran)</span>
                                                </h5>
                                            </td>
                                        @elseif($langganan->status_id == 3)
                                            <td>
                                                <h5>
                                                    <span class="badge badge-pill bg-success me-1">{{ $langganan->status->nama_status }}</span>
                                                </h5>
                                            </td>
                                            <td>
                                                <a class="btn btn-warning" href="{{ route('admin.edit_langganan', $langganan->id_langganan) }}" data-toggle="tooltip" title="Edit Langganan">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a class="btn btn-danger" href="{{ route('admin.nonaktif_langganan', $langganan->id_langganan) }}" data-toggle="tooltip" title="Nonaktif Langganan">
                                                    <i class="fa fa-ban"></i>
                                                </a>
                                            </td>
                                        @elseif($langganan->status_id == 4 || $langganan->status_id == 5)
                                            <td>
                                                <h5>
                                                    <span class="badge badge-pill bg-danger me-1">{{ $langganan->status->nama_status }}</span>
                                                </h5>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
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