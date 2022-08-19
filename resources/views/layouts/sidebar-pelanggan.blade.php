<!-- main-sidebar -->
<div class="sticky">
    <aside class="app-sidebar">
        <div class="main-sidebar-header active">
            <a class="header-logo active" href="index.html">
                <img src="{{ asset('nowa_assets') }}/img/brand/logo.png" class="main-logo  desktop-logo" alt="logo">
                <img src="{{ asset('nowa_assets') }}/img/brand/logo-white.png" class="main-logo  desktop-dark" alt="logo">
                <img src="{{ asset('nowa_assets') }}/img/brand/favicon.png" class="main-logo  mobile-logo" alt="logo">
                <img src="{{ asset('nowa_assets') }}/img/brand/favicon-white.png" class="main-logo  mobile-dark" alt="logo">
            </a>
        </div>
        <div class="main-sidemenu">
            <div class="slide-left disabled" id="slide-left"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24"><path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"/></svg></div>
            <ul class="side-menu">
                <li class="side-item side-item-category">Main</li>
                <li class="slide{{ $titlePage == 'Dashboard Pelanggan' ? ' is-expanded' : '' }}">
                    <a class="side-menu__item{{ $titlePage == 'Dashboard Pelanggan' ? ' active' : '' }}" href="{{ route('pelanggan.dashboard') }}">
                        <svg xmlns="http://www.w3.org/2000/svg"  class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24">
                            <path d="M3 13h1v7c0 1.103.897 2 2 2h12c1.103 0 2-.897 2-2v-7h1a1 1 0 0 0 .707-1.707l-9-9a.999.999 0 0 0-1.414 0l-9 9A1 1 0 0 0 3 13zm7 7v-5h4v5h-4zm2-15.586 6 6V15l.001 5H16v-5c0-1.103-.897-2-2-2h-4c-1.103 0-2 .897-2 2v5H6v-9.586l6-6z"/>
                        </svg>
                        <span class="side-menu__label">Dashboards</span>
                    </a>
                </li>
                {{--                        <li class="slide">--}}
                {{--                            <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">--}}
                {{--                                <svg xmlns="http://www.w3.org/2000/svg"  class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24">--}}
                {{--                                    <path d="M3 13h1v7c0 1.103.897 2 2 2h12c1.103 0 2-.897 2-2v-7h1a1 1 0 0 0 .707-1.707l-9-9a.999.999 0 0 0-1.414 0l-9 9A1 1 0 0 0 3 13zm7 7v-5h4v5h-4zm2-15.586 6 6V15l.001 5H16v-5c0-1.103-.897-2-2-2h-4c-1.103 0-2 .897-2 2v5H6v-9.586l6-6z"/>--}}
                {{--                                </svg>--}}
                {{--                                <span class="side-menu__label">Dashboards</span>--}}
                {{--                                <i class="angle fe fe-chevron-right"></i>--}}
                {{--                            </a>--}}
                {{--                            <ul class="slide-menu">--}}
                {{--                                <li class="side-menu__label1"><a href="javascript:void(0);">Dashboards</a></li>--}}
                {{--                                <li><a class="slide-item" href="index.html">Dashboard-1</a></li>--}}
                {{--                                <li><a class="slide-item" href="index1.html">Dashboard-2</a></li>--}}
                {{--                                <li><a class="slide-item" href="index2.html">Dashboard-3</a></li>--}}
                {{--                            </ul>--}}
                {{--                        </li>--}}
                <li class="side-item side-item-category">Langganan dan Pemesanan</li>
                {{--                langganan--}}
                <li class="slide{{ ($titlePage == 'Daftar Langganan') ? ' is-expanded' : '' }}">
                    <a class="side-menu__item{{ ($titlePage == 'Daftar Langganan') ? ' active' : '' }}" href="{{ route('pelanggan.langganan') }}" data-bs-toggle="slide">
                        <svg xmlns="http://www.w3.org/2000/svg"  class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24">
                            <path d="M11.86,2L11.34,3.93C15.75,4.78 19.2,8.23 20.05,12.65L22,12.13C20.95,7.03 16.96,3.04 11.86,2M10.82,5.86L10.3,7.81C13.34,8.27 15.72,10.65 16.18,13.68L18.12,13.16C17.46,9.44 14.55,6.5 10.82,5.86M3.72,9.69C3.25,10.73 3,11.86 3,13C3,14.95 3.71,16.82 5,18.28V22H8V20.41C8.95,20.8 9.97,21 11,21C12.14,21 13.27,20.75 14.3,20.28L3.72,9.69M9.79,9.76L9.26,11.72A3,3 0 0,1 12.26,14.72L14.23,14.2C14,11.86 12.13,10 9.79,9.76Z"/>
                        </svg>
                        <span class="side-menu__label">Daftar Langganan</span>
                    </a>
                </li>

                {{--invoice--}}
                <li class="side-item side-item-category">invoice</li>
                <li class="slide{{ $titlePage == 'Daftar Invoice' ? ' is-expanded' : '' }}">
                    <a class="side-menu__item{{ $titlePage == 'Daftar Invoice' ? ' active' : '' }}" href="{{ route('pelanggan.invoice') }}">
                        <svg xmlns="http://www.w3.org/2000/svg"  class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24">
                            <path d="M3,22L4.5,20.5L6,22L7.5,20.5L9,22L10.5,20.5L12,22L13.5,20.5L15,22L16.5,20.5L18,22L19.5,20.5L21,22V2L19.5,3.5L18,2L16.5,3.5L15,2L13.5,3.5L12,2L10.5,3.5L9,2L7.5,3.5L6,2L4.5,3.5L3,2M18,9H6V7H18M18,13H6V11H18M18,17H6V15H18V17Z"/>
                        </svg>
                        <span class="side-menu__label">Daftar Invoice</span>
                    </a>
                </li>
            </ul>
            <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24"><path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"/></svg></div>
        </div>
    </aside>
</div>
<!-- main-sidebar -->
