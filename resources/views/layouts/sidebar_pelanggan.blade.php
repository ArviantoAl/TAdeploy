<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Stisla</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            {{--dashboard--}}
            @if($titlePage == 'Dashboard Pelanggan')
                <li class="active">
            @else
                <li>
                    @endif
                    <a class="nav-link" href="{{ route('pelanggan.dashboard') }}"><i class="far fa-square"></i> <span>Dashboard</span></a></li>

                    <li class="menu-header">Layanan</li>
                    {{--layanan--}}
                    @if($titlePage == 'Daftar Layanan')
                        <li class="active">
                    @else
                        <li>
                            @endif
                            <a class="nav-link" href="{{route('pelanggan.layanan')}}"><i class="fas fa-users"></i> <span>Daftar Layanan</span></a></li>
                        {{--                    endlayanan--}}

                        {{--langganan dan invoice--}}
                        <li class="menu-header">Langganan dan Invoice</li>
                        {{--daftar langganan--}}
                        @if($titlePage == 'Daftar Langganan')
                            <li class="nav-item dropdown active">
                        @else
                            <li class="nav-item dropdown">
                                @endif
                                <a href="#" class="nav-link has-dropdown"><i class="fa fa-satellite-dish"></i> <span>Langganan</span></a>
                                <ul class="dropdown-menu">
                                    {{--semua langganan--}}
                                    @if($sub == 'Semua Langganan')
                                        <li class="active">
                                    @else
                                        <li>
                                            @endif
                                            <a href="{{ route('pelanggan.langganan') }}">Semua Langganan</a></li>
                                        {{--langganan baru--}}
                                        @if($sub == 'Langganan Baru')
                                            <li class="active">
                                        @else
                                            <li>
                                                @endif
                                                <a href="{{ route('pelanggan.langgananbaru') }}">Baru</a></li>
                                            {{--langganan disetujui--}}
                                            @if($sub == 'Langganan Disetujui')
                                                <li class="active">
                                            @else
                                                <li>
                                                    @endif
                                                    <a href="{{ route('pelanggan.langganansetuju') }}">Disetujui</a></li>
                                                {{--langganan menunggu--}}
                                                @if($sub == 'Langganan Menunggu Pembayaran')
                                                    <li class="active">
                                                @else
                                                    <li>
                                                        @endif
                                                        <a href="{{ route('pelanggan.langgananmenunggu') }}">Menunggu Pembayaran</a></li>
                                                    {{--langganan aktif--}}
                                                    @if($sub == 'Langganan Aktif')
                                                        <li class="active">
                                                    @else
                                                        <li>
                                                            @endif
                                                            <a href="{{ route('pelanggan.langgananaktif') }}">Aktif</a></li>
                                                        {{--langganan kadaluarsa--}}
                                                        @if($sub == 'Langganan Kadaluarsa')
                                                            <li class="active">
                                                        @else
                                                            <li>
                                                                @endif
                                                                <a href="{{ route('pelanggan.langganankadaluarsa') }}">Kadaluarsa</a></li>
                                                            {{--langganan batal--}}
                                                            @if($sub == 'Langganan Batal')
                                                                <li class="active">
                                                            @else
                                                                <li>
                                                                    @endif
                                                                    <a href="{{ route('pelanggan.langgananbatal') }}">Batal</a></li>
                                </ul>
                            </li>
                            {{--daftar invoice--}}
                            @if($titlePage == 'Daftar Invoice')
                                <li class="nav-item dropdown active">
                            @else
                                <li class="nav-item dropdown">
                                    @endif
                                    <a href="#" class="nav-link has-dropdown"><i class="fa fa-file-invoice"></i> <span>Invoice</span></a>
                                    <ul class="dropdown-menu">
                                        {{--semua invoice--}}
                                        @if($sub == 'Semua Invoice')
                                            <li class="active">
                                        @else
                                            <li>
                                                @endif
                                                <a href="{{ route('pelanggan.invoice') }}">Semua Invoice</a></li>
                                            {{--invoice belum dikirim--}}
                                            @if($sub == 'Invoice Belum Dikirim')
                                                <li class="active">
                                            @else
                                                <li>
                                                    @endif
                                                    <a href="{{ route('pelanggan.inv_belumkirim') }}">Belum Dikirim</a></li>
                                                {{--invoice melebihi batas--}}
                                                @if($sub == 'Invoice Melebihi Batas Pembayaran')
                                                    <li class="active">
                                                @else
                                                    <li>
                                                        @endif
                                                        <a href="{{ route('pelanggan.inv_melebihibatas') }}">Melebihi Batas Bayar</a></li>
                                                    {{--invoice menunggu--}}
                                                    @if($sub == 'Invoice Menunggu Pembayaran')
                                                        <li class="active">
                                                    @else
                                                        <li>
                                                            @endif
                                                            <a href="{{ route('pelanggan.inv_menunggu') }}">Menunggu Pembayaran</a></li>
                                                        {{--invoice lunas--}}
                                                        @if($sub == 'Invoice Lunas')
                                                            <li class="active">
                                                        @else
                                                            <li>
                                                                @endif
                                                                <a href="{{ route('pelanggan.inv_lunas') }}">Lunas</a></li>
                                                            {{--invoice batal--}}
                                                            @if($sub == 'Invoice Tidak Dibayar/Batal')
                                                                <li class="active">
                                                            @else
                                                                <li>
                                                                    @endif
                                                                    <a href="{{ route('pelanggan.inv_batal') }}">Tidak Dibayar/Batal</a></li>
                                    </ul>
                                </li>
        </ul>
    </aside>
</div>
