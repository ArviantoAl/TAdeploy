@extends('layouts.nowa',[
    'titlePage' => __('Edit Master Mikrotik'),
])

@section('content')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <span class="main-content-title mg-b-0 mg-b-lg-1">Edit Master Mikrotik</span>
        </div>
        <div class="justify-content-center mt-2">
            <ol class="breadcrumb">
                <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Data Master Mikrotik</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Master Mikrotik</li>
            </ol>
        </div>
    </div>
    <!-- /breadcrumb -->

    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
        <div class="card  box-shadow-0 ">
            <div class="card-header">
                <h4 class="card-title mb-1">Form Edit Master Mikrotik</h4>
                <p class="mb-2">Ubah data baru untuk data Master Mikrotik tersebut.</p>
            </div>
            <div class="card-body pt-0">
                <form method="POST" action="{{ route('teknisi.posteditmastermikrotik', $master_mikrotik->id_master) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="uname" class="form-label">User Name</label>
                        <input class="form-control" id="uname" name="uname" value="{{$master_mikrotik->uname}}" placeholder="Masukkan User Name" type="String" required autocomplete="uname" autofocus>
                    </div>
                    <div class="form-group">
                        <label for="pw" class="form-label">Password</label>
                        <input class="form-control" id="pw" name="pw" value="{{$master_mikrotik->password}}"  type="String" required autocomplete="pw" autofocus>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3 mb-0">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection