@extends('layouts.nowa',[
    'titlePage' => __('Profil CV'),
])

@section('content')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <span class="main-content-title mg-b-0 mg-b-lg-1">Profil CV</span>
        </div>
        <div class="justify-content-center mt-2">
            <ol class="breadcrumb">
                <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Data Profil CV</a></li>
                <li class="breadcrumb-item active" aria-current="page">Profil CV</li>
            </ol>
        </div>
    </div>
    <!-- /breadcrumb -->

    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="row">
                <div class="btn-group ms-2 mt-2 mb-2">
                    <a style="color: white" class="btn btn-success" href="{{route('admin.editcv',1)}}">
                        {{ __('Edit Profil CV') }}
                    </a>
                </div>
                <div class="btn-group mt-2 mb-2">
                    <a style="color: white" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#logo">
                        {{__('Edit Logo dan Ikon Profil CV')}}
                    </a>
                </div>
            </div>
            <div class="card custom-card">
                <div class="card-body d-md-flex">
                    <div class="">
                        <span class="profile-image pos-relative">
                            <img class="br-5" alt="" src="{{ asset('nowa_assets') }}/img/brand/logo.png">
                        </span>
                    </div>
                    <div class="my-md-auto mt-4 prof-details">
                        <h4 class="font-weight-semibold ms-md-4 ms-0 mb-1 pb-0">{{$profil->nama_cv}}</h4>
                        <p class="tx-13 text-muted ms-md-4 ms-0 mb-2 pb-2 ">
{{--alamat--}}
                            <span><i class="far fa-flag me-2"></i>{{ $profil->alamat }}</span>
                        </p>
                        <p class="text-muted ms-md-4 ms-0 mb-2">
                            <span><i class="fa fa-phone me-2"></i></span>
                            <span class="font-weight-semibold me-2">:</span><span>{{ $profil->no_hp }}</span>
                        </p>
                        <p class="text-muted ms-md-4 ms-0 mb-2">
                            <span><i class="fa fa-envelope me-2"></i></span>
                            <span class="font-weight-semibold me-2">:</span><span>{{$profil->email_cv}}</span>
                        </p>
                        <p class="text-muted ms-md-4 ms-0 mb-2">
                            <span><i class="fa fa-globe me-2"></i></span>
                            <span class="font-weight-semibold me-2">:</span><span>{{$profil->web_cv}}</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('modal')
    <div class="modal" id="logo">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Ubah Logo dan Ikon CV</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="pd-30 pd-sm-20">
                        <div class="panel panel-primary">
                            <div class=" tab-menu-heading mb-2 border-bottom-0">
                                <div class="tabs-menu1">
                                    <ul class="nav panel-tabs">
                                        <li>
                                            <a href="#tab6" data-bs-toggle="tab" class="active">Logo</a>
                                        </li>
                                        <li>
                                            <a href="#tab7" data-bs-toggle="tab" class="">Ikon</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="panel-body tabs-menu-body border-0 p-3">
                                <div class="tab-content">

                                    <div class="tab-pane active" id="tab6">
                                        <form method="POST" action="{{ route('admin.editlogo') }}" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="form-group">
                                                    <label for="logo">Logo CV</label>
                                                    <div class="dropify-preview mb-2">
                                    <span class="dropify-render profile-image pos-relative">
                                        <img src="{{ asset('nowa_assets') }}/img/brand/logo.png" style="max-width: 200px">
                                    </span>
                                                    </div>
                                                    <input id="logo" type="file" class="dropify" name="logo" data-height="100"/>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary mt-3 mb-0">Submit</button>
                                        </form>
                                    </div>

                                    <div class="tab-pane" id="tab7">
                                        <form method="POST" action="{{ route('admin.editlogo') }}" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="form-group">
                                                    <label for="logo">Ikon CV</label>
                                                    <div class="dropify-preview mb-2">
                                                        <span class="dropify-render profile-image pos-relative">
                                                            <img src="{{ asset('nowa_assets') }}/img/brand/favicon.png" style="max-width: 200px">
                                                        </span>
                                                    </div>
                                                    <input id="logo" type="file" class="dropify" name="ikon" data-height="100"/>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary mt-3 mb-0">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
@endsection
