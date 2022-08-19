@extends('layouts.app',[
    'titlePage' => __('Dashboard Teknisi'),
    'sub' => ' '
])

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        anda adalah Teknisi
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
