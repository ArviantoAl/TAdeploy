@extends('layouts.nowa',[
    'titlePage' => __('Log Activity'),
])

@section('content')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <span class="main-content-title mg-b-0 mg-b-lg-1">Daftar Log Activity</span>
        </div>
        <div class="justify-content-center mt-2">
            <ol class="breadcrumb">
                <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Data Log Activity</a></li>
                <li class="breadcrumb-item active" aria-current="page">Daftar Log Activity</li>
            </ol>
        </div>
    </div>
    <!-- /breadcrumb -->

    <!-- Row -->
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card custom-card overflow-hidden">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped mg-b-0 text-md-nowrap">
                            <thead style="text-align: center">
                            <tr>
                                <th>No</th>
                                <th>Subject</th>
                                <th>URL</th>
                                <th>Method</th>
                                <th>Ip</th>
                                <th>User Agent</th>
                                <th>Nama</th>
                                <th>waktu</th>
                            </tr>
                            </thead>
                            <tbody style="text-align: center">
                            @foreach ($logs as $no => $ll)
                                <tr>
                                    <td>{{ $no+1 }}</td>
                                    <td>{{ $ll->subject }}</td>
                                    <td>{{ $ll->url }}</td>
                                    <td>{{ $ll->method }}</td>
                                    <td>{{ $ll->ip }}</td>
                                    <td>{{ $ll->agent }}</td>
                                    <td>{{ $ll->pelanggan->name }}</td>
                                    <td>{{ $ll->waktu }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $logs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
