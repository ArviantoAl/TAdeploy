@extends('layouts.nowa',[
    'titlePage' => __('Teknisi Tambah Perangkat BTS'),
])

@section('content')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <span class="main-content-title mg-b-0 mg-b-lg-1">Edit Perangkat BTS teknisi</span>
        </div>
        <div class="justify-content-center mt-2">
            <ol class="breadcrumb">
                <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Data Perangkat BTS teknisi</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Perangkat BTS teknisi</li>
            </ol>
        </div>
    </div>
    <!-- /breadcrumb -->

    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
        <div class="card  box-shadow-0 ">
            <div class="card-header">
                <h4 class="card-title mb-1">Form Edit Perangkat BTS teknisi</h4>
                <p class="mb-2">Isi data form berikut untuk menambahkan Perangkat BTS.</p>
            </div>
            <div class="card-body pt-0">
                @if (session()->has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ session()->get('error') }}</strong>
                        <button aria-label="Close" class="btn-close" data-bs-dismiss="alert" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                @endif
                <form method="POST" action="{{ route('teknisi.editloginbts', $bts->id_bts) }}">
                    @csrf
                    <div class="form-group">
                        <label for="ip" class="form-label">IP Address</label>
                        <input class="form-control" id="ip" value="{{$bts->ip}}" name="ip" placeholder="Masukkan IP Address" type="text" required autocomplete="ip" autofocus>
                    </div>
                    <div class="form-group">
                        <label for="Uname" class="form-label">User Name</label>
                        <select class="form-control" id="Uname" name="Uname" placeholder="" type="String" required autocomplete="Uname" autofocus>
                            {{-- <select name="uname" type="String" id="uname" class="form-control" required autocomplete="Uname" autofocus> --}}
                                <option value="">Pilih User Name</option>
                                @foreach ($master_mikrotik as $item)
                                    <option value="{{ $item->uname }}">{{ $item->uname }}</option>
                                @endforeach
                            </select>
                    </div>
                    <div class="form-group">
                        <label for="pw" class="form-label">Password</label>
                        <input class="form-control" id="pw" name="pw" placeholder="Password" type="String" required autocomplete="pw" autofocus>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3 mb-0">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
{{-- <script>
    $(document).ready(function() {

        $('#uname').on('change', function() {
            var Uname = this.value;
            // $("#uname").html('');
            $.ajax({
                url: "{{ url('api/master-mikrotik') }}",
                type: "POST",
                data: {
                    Uname: Uname,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(result) {
                    console.log(result)
                    // document.getElementById('uname').value = result.pw;
                    document.getElementById('pw').value = result.pw;
                    // console.log(result);
                    // $.each(result, function(key, value) {
                    //     $("#pw").append('<option value="' + value
                    //         .id + '">' + value.nama + '</option>');
                        
                    // });
                    // $('#sub-district').html('<option value="">-- Select City --</option>');
                }
            });
        });
    });
</script> --}}
<script type="text/javascript">
    $(document).ready( function() {
        var Uname = this.value;
            // $("#uname").html('');
            $.ajax({
                url: "{{ url('api/master-mikrotik') }}",
                type: "POST",
                data: {
                    Uname: Uname,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(result) {
                    console.log(result)}
        $('#uname').on('change', function() {
            $('#pw').val($(this).val());
        });
        });
    });
    
    </script>
@endpush