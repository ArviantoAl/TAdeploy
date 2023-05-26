<!-- main-sidebar -->
<div class="sticky">
    <aside class="app-sidebar">
        <div class="main-sidebar-header active">
            <a class="header-logo active" href="">
                <img src="{{ asset('nowa_assets') }}/img/brand/logo.png" class="main-logo  desktop-logo" alt="logo">
                <img src="{{ asset('nowa_assets') }}/img/brand/logo.png" class="main-logo  desktop-dark" alt="logo">
                <img src="{{ asset('nowa_assets') }}/img/brand/favicon.png" class="main-logo  mobile-logo" alt="logo">
                <img src="{{ asset('nowa_assets') }}/img/brand/favicon.png" class="main-logo  mobile-dark" alt="logo">
            </a>
        </div>
        <div class="main-sidemenu">
            <div class="slide-left disabled" id="slide-left"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24"><path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"/></svg></div>
            <ul class="side-menu">
                <li class="side-item side-item-category">Main</li>
                <li class="slide{{ $titlePage == 'Dashboard Admin' ? ' is-expanded' : '' }}">
                    <a class="side-menu__item{{ $titlePage == 'Dashboard Admin' ? ' active' : '' }}" href="{{ route('admin.dashboard') }}">
                        <svg xmlns="http://www.w3.org/2000/svg"  class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24">
                            <path d="M3 13h1v7c0 1.103.897 2 2 2h12c1.103 0 2-.897 2-2v-7h1a1 1 0 0 0 .707-1.707l-9-9a.999.999 0 0 0-1.414 0l-9 9A1 1 0 0 0 3 13zm7 7v-5h4v5h-4zm2-15.586 6 6V15l.001 5H16v-5c0-1.103-.897-2-2-2h-4c-1.103 0-2 .897-2 2v5H6v-9.586l6-6z"/>
                        </svg>
                        <span class="side-menu__label">Dashboards</span>
                    </a>
                </li>

                <li class="side-item side-item-category">Master</li>
                <li class="slide{{ $titlePage == 'Profil CV' ? ' is-expanded' : '' }}">
                    <a class="side-menu__item{{ ($titlePage == 'Profil CV'|| $titlePage == 'Edit Profil') ? ' active' : '' }}" href="{{route('admin.profilcv')}}">
                        <svg xmlns="http://www.w3.org/2000/svg"  class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24">
                            <path d="M18,15H16V17H18M18,11H16V13H18M20,19H12V17H14V15H12V13H14V11H12V9H20M10,7H8V5H10M10,11H8V9H10M10,15H8V13H10M10,19H8V17H10M6,7H4V5H6M6,11H4V9H6M6,15H4V13H6M6,19H4V17H6M12,7V3H2V21H22V7H12Z"/>
                        </svg>
                        <span class="side-menu__label">Profil</span>
                    </a>
                </li>
                <li class="slide{{ ($titlePage == 'Daftar PPN'|| $titlePage == 'Edit PPN' || $titlePage == 'Tambah PPN') ? ' is-expanded' : '' }}">
                    <a class="side-menu__item{{ ($titlePage == 'Daftar PPN'|| $titlePage == 'Edit PPN' || $titlePage == 'Tambah PPN') ? ' active' : '' }}" href="{{route('admin.ppn')}}">
                        <svg xmlns="http://www.w3.org/2000/svg"  class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24">
                            <path d="M20.04,8.71V4H15.34L12,0.69L8.71,4H4V8.71L0.69,12L4,15.34V20.04H8.71L12,23.35L15.34,20.04H20.04V15.34L23.35,12L20.04,8.71M8.83,7.05C9.81,7.05 10.6,7.84 10.6,8.83A1.77,1.77 0 0,1 8.83,10.6C7.84,10.6 7.05,9.81 7.05,8.83C7.05,7.84 7.84,7.05 8.83,7.05M15.22,17C14.24,17 13.45,16.2 13.45,15.22A1.77,1.77 0 0,1 15.22,13.45C16.2,13.45 17,14.24 17,15.22A1.78,1.78 0 0,1 15.22,17M8.5,17.03L7,15.53L15.53,7L17.03,8.5L8.5,17.03Z"/>
                        </svg>
                        <span class="side-menu__label">Daftar PPN</span>
                    </a>
                </li>
                <li class="slide{{ ($titlePage == 'Daftar Metode Pembayaran'|| $titlePage == 'Edit Metode Pembayaran' || $titlePage == 'Tambah Metode Pembayaran') ? ' is-expanded' : '' }}">
                    <a class="side-menu__item{{ ($titlePage == 'Daftar Metode Pembayaran'|| $titlePage == 'Edit Metode Pembayaran' || $titlePage == 'Tambah Metode Pembayaran') ? ' active' : '' }}" href="{{route('admin.metode')}}">
                        <svg xmlns="http://www.w3.org/2000/svg"  class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24">
                            <path d="M22,14.5859a2.5038,2.5038,0,0,0-2-2.4494V10.5859a2.5026,2.5026,0,0,0-2.5-2.5h-.793L12.2676,3.6465a2.5027,2.5027,0,0,0-3.5352,0L4.27,8.1093A2.4944,2.4944,0,0,0,2,10.5859v8a2.5026,2.5026,0,0,0,2.5,2.5h13a2.5026,2.5026,0,0,0,2.5-2.5V17.0353A2.5037,2.5037,0,0,0,22,14.5859ZM9.44,4.3535a1.5012,1.5012,0,0,1,2.121,0L15.293,8.0859H5.707ZM17.5,20.0859H4.5a1.5016,1.5016,0,0,1-1.5-1.5v-8a1.5017,1.5017,0,0,1,1.5-1.5h13a1.5017,1.5017,0,0,1,1.5,1.5v1.5H17.5a2.5,2.5,0,0,0,0,5H19v1.5A1.5016,1.5016,0,0,1,17.5,20.0859Zm2-4h-2a1.5,1.5,0,0,1,0-3h2a1.5,1.5,0,1,1,0,3Z"/>
                        </svg>
                        <span class="side-menu__label">Metode Pembayaran</span>
                    </a>
                </li>
                <li class="slide{{ ($titlePage == 'Daftar Kategori Bank'|| $titlePage == 'Edit Kategori Bank' || $titlePage == 'Tambah Kategori Bank') ? ' is-expanded' : '' }}">
                    <a class="side-menu__item{{ ($titlePage == 'Daftar Kategori Bank'|| $titlePage == 'Edit Kategori Bank' || $titlePage == 'Tambah Kategori Bank') ? ' active' : '' }}" href="{{route('admin.bank')}}">
                        <svg xmlns="http://www.w3.org/2000/svg"  class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24">
                            <path d="M2 20h20v2H2v-2zm2-8h2v7H4v-7zm5 0h2v7H9v-7zm4 0h2v7h-2v-7zm5 0h2v7h-2v-7zM2 7l10-5 10 5v4H2V7zm2 1.236V9h16v-.764l-8-4-8 4zM12 8a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                        </svg>
                        <span class="side-menu__label">Daftar Bank</span>
                    </a>
                </li>
                <li class="slide{{ $titlePage == 'Peta Langganan' ? ' is-expanded' : '' }}">
                    <a class="side-menu__item{{ $titlePage == 'Peta Langganan' ? ' active' : '' }}" href="{{route('admin.maplang')}}">
                        <svg xmlns="http://www.w3.org/2000/svg"  class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24">
                            <path d="M15,19L9,16.89V5L15,7.11M20.5,3C20.44,3 20.39,3 20.34,3L15,5.1L9,3L3.36,4.9C3.15,4.97 3,5.15 3,5.38V20.5A0.5,0.5 0 0,0 3.5,21C3.55,21 3.61,21 3.66,20.97L9,18.9L15,21L20.64,19.1C20.85,19 21,18.85 21,18.62V3.5A0.5,0.5 0 0,0 20.5,3Z"/>
                        </svg>
                        <span class="side-menu__label">Peta Langganan</span>
                    </a>
                </li>
                <li class="slide{{ $titlePage == 'Log Activity' ? ' is-expanded' : '' }}">
                    <a class="side-menu__item{{ $titlePage == 'Log Activity' ? ' active' : '' }}" href="{{route('admin.actlog')}}">
                        <svg xmlns="http://www.w3.org/2000/svg"  class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24">
                            <path d="M19 3H5C3.9 3 3 3.9 3 5V19C3 20.1 3.9 21 5 21H19C20.1 21 21 20.1 21 19V5C21 3.9 20.1 3 19 3M7 7H9V9H7V7M7 11H9V13H7V11M7 15H9V17H7V15M17 17H11V15H17V17M17 13H11V11H17V13M17 9H11V7H17V9Z"/>
                        </svg>
                        <span class="side-menu__label">Log Activity</span>
                    </a>
                </li>

                <li class="side-item side-item-category">BTS</li>
                <li class="slide{{ ($titlePage == 'Daftar Lokasi'|| $titlePage == 'Edit Lokasi' || $titlePage == 'Tambah Lokasi') ? ' is-expanded' : '' }}">
                    <a class="side-menu__item{{ ($titlePage == 'Daftar Lokasi'|| $titlePage == 'Edit Lokasi' || $titlePage == 'Tambah Lokasi') ? ' active' : '' }}" href="{{route('admin.lokasi')}}">
                        <svg xmlns="http://www.w3.org/2000/svg"  class="side-menu__icon" width="24" height="24" viewBox="-64 0 512 512">
                            <path d="M172.268 501.67C26.97 291.031 0 269.413 0 192 0 85.961 85.961 0 192 0s192 85.961 192 192c0 77.413-26.97 99.031-172.268 309.67-9.535 13.774-29.93 13.773-39.464 0zM192 272c44.183 0 80-35.817 80-80s-35.817-80-80-80-80 35.817-80 80 35.817 80 80 80z"/>
                        </svg>
                        <span class="side-menu__label">Daftar Lokasi</span>
                    </a>
                </li>
                <li class="slide{{ ($titlePage == 'Daftar Frekuensi'|| $titlePage == 'Edit Frekuensi' || $titlePage == 'Tambah Frekuensi') ? ' is-expanded' : '' }}">
                    <a class="side-menu__item{{ ($titlePage == 'Daftar Frekuensi'|| $titlePage == 'Edit Frekuensi' || $titlePage == 'Tambah Frekuensi') ? ' active' : '' }}" href="{{route('admin.frek')}}">
                        <svg xmlns="http://www.w3.org/2000/svg"  class="side-menu__icon" width="24" height="24" viewBox="0 0 47 47">
                            <path d="M24.104,41.577c-0.025,0-0.053-0.001-0.078-0.001c-1.093-0.035-2.025-0.802-2.271-1.867l-5.46-23.659l-3.199,8.316 c-0.357,0.93-1.252,1.544-2.249,1.544H2.41c-1.331,0-2.41-1.079-2.41-2.41c0-1.331,1.079-2.41,2.41-2.41h6.78l5.433-14.122 c0.38-0.989,1.351-1.612,2.418-1.54c1.057,0.074,1.941,0.831,2.18,1.863l5.186,22.474l4.618-15.394 c0.276-0.923,1.078-1.592,2.035-1.702c0.953-0.107,1.889,0.36,2.365,1.198l4.127,7.222h7.037c1.331,0,2.41,1.079,2.41,2.41 c0,1.331-1.079,2.41-2.41,2.41h-8.436c-0.865,0-1.666-0.463-2.094-1.214l-2.033-3.559l-5.616,18.722 C26.104,40.88,25.164,41.577,24.104,41.577z"/>
                        </svg>
                        <span class="side-menu__label">Daftar Frekuensi</span>
                    </a>
                </li>
                <li class="slide{{ ($titlePage == 'Daftar Jenis BTS'|| $titlePage == 'Edit Jenis BTS' || $titlePage == 'Tambah Jenis BTS') ? ' is-expanded' : '' }}">
                    <a class="side-menu__item{{ ($titlePage == 'Daftar Jenis BTS'|| $titlePage == 'Edit Jenis BTS' || $titlePage == 'Tambah Jenis BTS') ? ' active' : '' }}" href="{{route('admin.jenis')}}">
                        <svg xmlns="http://www.w3.org/2000/svg"  class="side-menu__icon" width="24" height="24" viewBox="0 -64 640 640">
                            <path d="M497.941 225.941L286.059 14.059A48 48 0 0 0 252.118 0H48C21.49 0 0 21.49 0 48v204.118a48 48 0 0 0 14.059 33.941l211.882 211.882c18.744 18.745 49.136 18.746 67.882 0l204.118-204.118c18.745-18.745 18.745-49.137 0-67.882zM112 160c-26.51 0-48-21.49-48-48s21.49-48 48-48 48 21.49 48 48-21.49 48-48 48zm513.941 133.823L421.823 497.941c-18.745 18.745-49.137 18.745-67.882 0l-.36-.36L527.64 323.522c16.999-16.999 26.36-39.6 26.36-63.64s-9.362-46.641-26.36-63.64L331.397 0h48.721a48 48 0 0 1 33.941 14.059l211.882 211.882c18.745 18.745 18.745 49.137 0 67.882z"/>
                        </svg>
                        <span class="side-menu__label">Daftar Jenis BTS</span>
                    </a>
                </li>
                <li class="slide{{ ($titlePage == 'Daftar Perangkat BTS'|| $titlePage == 'Edit Perangkat BTS' || $titlePage == 'Tambah Perangkat BTS') ? ' is-expanded' : '' }}">
                    <a class="side-menu__item{{ ($titlePage == 'Daftar Perangkat BTS'|| $titlePage == 'Edit Perangkat BTS' || $titlePage == 'Tambah Perangkat BTS') ? ' active' : '' }}" href="{{route('admin.bts')}}">
                        <svg xmlns="http://www.w3.org/2000/svg"  class="side-menu__icon" width="24" height="24" viewBox="0 -64 640 640">
                            <path d="M150.94 192h33.73c11.01 0 18.61-10.83 14.86-21.18-4.93-13.58-7.55-27.98-7.55-42.82s2.62-29.24 7.55-42.82C203.29 74.83 195.68 64 184.67 64h-33.73c-7.01 0-13.46 4.49-15.41 11.23C130.64 92.21 128 109.88 128 128c0 18.12 2.64 35.79 7.54 52.76 1.94 6.74 8.39 11.24 15.4 11.24zM89.92 23.34C95.56 12.72 87.97 0 75.96 0H40.63c-6.27 0-12.14 3.59-14.74 9.31C9.4 45.54 0 85.65 0 128c0 24.75 3.12 68.33 26.69 118.86 2.62 5.63 8.42 9.14 14.61 9.14h34.84c12.02 0 19.61-12.74 13.95-23.37-49.78-93.32-16.71-178.15-.17-209.29zM614.06 9.29C611.46 3.58 605.6 0 599.33 0h-35.42c-11.98 0-19.66 12.66-14.02 23.25 18.27 34.29 48.42 119.42.28 209.23-5.72 10.68 1.8 23.52 13.91 23.52h35.23c6.27 0 12.13-3.58 14.73-9.29C630.57 210.48 640 170.36 640 128s-9.42-82.48-25.94-118.71zM489.06 64h-33.73c-11.01 0-18.61 10.83-14.86 21.18 4.93 13.58 7.55 27.98 7.55 42.82s-2.62 29.24-7.55 42.82c-3.76 10.35 3.85 21.18 14.86 21.18h33.73c7.02 0 13.46-4.49 15.41-11.24 4.9-16.97 7.53-34.64 7.53-52.76 0-18.12-2.64-35.79-7.54-52.76-1.94-6.75-8.39-11.24-15.4-11.24zm-116.3 100.12c7.05-10.29 11.2-22.71 11.2-36.12 0-35.35-28.63-64-63.96-64-35.32 0-63.96 28.65-63.96 64 0 13.41 4.15 25.83 11.2 36.12l-130.5 313.41c-3.4 8.15.46 17.52 8.61 20.92l29.51 12.31c8.15 3.4 17.52-.46 20.91-8.61L244.96 384h150.07l49.2 118.15c3.4 8.16 12.76 12.01 20.91 8.61l29.51-12.31c8.15-3.4 12-12.77 8.61-20.92l-130.5-313.41zM271.62 320L320 203.81 368.38 320h-96.76z"/>
                        </svg>
                        <span class="side-menu__label">Daftar Perangkat BTS</span>
                    </a>
                </li>


                <li class="side-item side-item-category">Layanan</li>
                <li class="slide{{ ($titlePage == 'Daftar Layanan'|| $titlePage == 'Edit Layanan') ? ' is-expanded' : '' }}">
                    <a class="side-menu__item{{ ($titlePage == 'Daftar Layanan' || $titlePage == 'Edit Layanan') ? ' active' : '' }}" href="{{route('admin.layanan')}}">
                        <svg xmlns="http://www.w3.org/2000/svg"  class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24">
                            <path d="M19.35,10.03C18.67,6.59 15.64,4 12,4C9.11,4 6.6,5.64 5.35,8.03C2.34,8.36 0,10.9 0,14A6,6 0 0,0 6,20H19A5,5 0 0,0 24,15C24,12.36 21.95,10.22 19.35,10.03Z"/>
                        </svg>
                        <span class="side-menu__label">Daftar Layanan</span>
                    </a>
                </li>
{{--                <li class="slide{{ $titlePage == 'Tambah Layanan' ? ' is-expanded' : '' }}">--}}
{{--                    <a class="side-menu__item{{ $titlePage == 'Tambah Layanan' ? ' active' : '' }}" href="{{route('admin.tambahlayanan')}}">--}}
{{--                        <svg xmlns="http://www.w3.org/2000/svg"  class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24">--}}
{{--                            <path d="M17,13H13V17H11V13H7V11H11V7H13V11H17M19,3H5C3.89,3 3,3.89 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V5C21,3.89 20.1,3 19,3Z"/>--}}
{{--                        </svg>--}}
{{--                        <span class="side-menu__label">Tambah Layanan</span>--}}
{{--                    </a>--}}
{{--                </li>--}}

                <li class="side-item side-item-category">User</li>
               <li class="slide{{ ($titlePage == 'Daftar Semua User' || $titlePage == 'Tambah User') ? ' is-expanded' : '' }}">
                   <a class="side-menu__item{{ ($titlePage == 'Daftar Semua User' || $titlePage == 'Tambah User' || $titlePage == 'Edit User') ? ' active' : '' }}" data-bs-toggle="slide" href="javascript:void(0);">
                       <svg xmlns="http://www.w3.org/2000/svg"  class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24">
                           <path d="M12,5.5A3.5,3.5 0 0,1 15.5,9A3.5,3.5 0 0,1 12,12.5A3.5,3.5 0 0,1 8.5,9A3.5,3.5 0 0,1 12,5.5M5,8C5.56,8 6.08,8.15 6.53,8.42C6.38,9.85 6.8,11.27 7.66,12.38C7.16,13.34 6.16,14 5,14A3,3 0 0,1 2,11A3,3 0 0,1 5,8M19,8A3,3 0 0,1 22,11A3,3 0 0,1 19,14C17.84,14 16.84,13.34 16.34,12.38C17.2,11.27 17.62,9.85 17.47,8.42C17.92,8.15 18.44,8 19,8M5.5,18.25C5.5,16.18 8.41,14.5 12,14.5C15.59,14.5 18.5,16.18 18.5,18.25V20H5.5V18.25M0,20V18.5C0,17.11 1.89,15.94 4.45,15.6C3.86,16.28 3.5,17.22 3.5,18.25V20H0M24,20H20.5V18.25C20.5,17.22 20.14,16.28 19.55,15.6C22.11,15.94 24,17.11 24,18.5V20Z"/>
                       </svg>
                       <span class="side-menu__label">Data User</span>
                       <i class="angle fe fe-chevron-right"></i>
                   </a>
                   <ul class="slide-menu">
                       <li class="side-menu__label1"><a href="javascript:void(0);">Data User</a></li>
                       <li><a class="slide-item{{ $titlePage == 'Daftar Semua User' ? ' active' : '' }}" href="{{route('admin.user')}}">Daftar Semua User</a></li>
                       <li><a class="slide-item{{ $titlePage == 'Tambah User' ? ' active' : '' }}" href="{{route('admin.tambahuser')}}">Tambah User</a></li>
                   </ul>
               </li>
                <li class="slide{{ $titlePage == 'Daftar Pelanggan Aktif' ? ' is-expanded' : '' }}">
                    <a class="side-menu__item{{ $titlePage == 'Daftar Pelanggan Aktif' ? ' active' : '' }}" href="{{route('admin.pelangganaktif')}}">
                        <svg xmlns="http://www.w3.org/2000/svg"  class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24">
                            <path d="M21.1,12.5L22.5,13.91L15.97,20.5L12.5,17L13.9,15.59L15.97,17.67L21.1,12.5M10,17L13,20H3V18C3,15.79 6.58,14 11,14L12.89,14.11L10,17M11,4A4,4 0 0,1 15,8A4,4 0 0,1 11,12A4,4 0 0,1 7,8A4,4 0 0,1 11,4Z"/>
                        </svg>
                        <span class="side-menu__label">Daftar Pelanggan</span>
                    </a>
                </li>

                {{-- <li class="side-item side-item-category">Pengelolaan</li>
                <li class="slide{{ $titlePage == 'Daftar User' ? ' is-expanded' : '' }}">
                    <a class="side-menu__item{{ $titlePage == 'Daftar User' ? ' active' : '' }}"
                        href="{{ url('admin/users') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" width="24" height="24"
                            viewBox="0 0 24 24">
                            <path
                                d="M21.1,12.5L22.5,13.91L15.97,20.5L12.5,17L13.9,15.59L15.97,17.67L21.1,12.5M10,17L13,20H3V18C3,15.79 6.58,14 11,14L12.89,14.11L10,17M11,4A4,4 0 0,1 15,8A4,4 0 0,1 11,12A4,4 0 0,1 7,8A4,4 0 0,1 11,4Z" />
                        </svg>
                        <span class="side-menu__label">Daftar User</span>
                    </a>
                </li> --}}

                <li class="side-item side-item-category">Langganan dan Pemesanan</li>
                {{--                langganan--}}
{{--                <li class="slide{{ ($titlePage == 'Daftar langganan') ? ' is-expanded' : '' }}">--}}
{{--                    <a class="side-menu__item{{ ($titlePage == 'Daftar langganan') ? ' active' : '' }}" href="{{ route('admin.langganan') }}" data-bs-toggle="slide">--}}
{{--                        <svg xmlns="http://www.w3.org/2000/svg"  class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24">--}}
{{--                            <path d="M11.86,2L11.34,3.93C15.75,4.78 19.2,8.23 20.05,12.65L22,12.13C20.95,7.03 16.96,3.04 11.86,2M10.82,5.86L10.3,7.81C13.34,8.27 15.72,10.65 16.18,13.68L18.12,13.16C17.46,9.44 14.55,6.5 10.82,5.86M3.72,9.69C3.25,10.73 3,11.86 3,13C3,14.95 3.71,16.82 5,18.28V22H8V20.41C8.95,20.8 9.97,21 11,21C12.14,21 13.27,20.75 14.3,20.28L3.72,9.69M9.79,9.76L9.26,11.72A3,3 0 0,1 12.26,14.72L14.23,14.2C14,11.86 12.13,10 9.79,9.76Z"/>--}}
{{--                        </svg>--}}
{{--                        <span class="side-menu__label">Daftar Langganan</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
                {{--                pemesanan--}}
                <li class="slide{{ ($titlePage == 'Form Pemesanan') ? ' is-expanded' : '' }}">
                    <a class="side-menu__item{{ ($titlePage == 'Form Pemesanan') ? ' active' : '' }}" href="{{ route('admin.form_pemesanan') }}" data-bs-toggle="slide">
                        <svg xmlns="http://www.w3.org/2000/svg"  class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24">
                            <path d="M21.04 13.13C21.18 13.13 21.31 13.19 21.42 13.3L22.7 14.58C22.92 14.79 22.92 15.14 22.7 15.35L21.7 16.35L19.65 14.3L20.65 13.3C20.76 13.19 20.9 13.13 21.04 13.13M19.07 14.88L21.12 16.93L15.06 23H13V20.94L19.07 14.88M3 7V5H5V4C5 2.89 5.9 2 7 2H13V9L15.5 7.5L18 9V2H19C20.05 2 21 2.95 21 4V10L11 20V22H7C5.95 22 5 21.05 5 20V19H3V17H5V13H3V11H5V7H3M5 7H7V5H5V7M5 11V13H7V11H5M5 17V19H7V17H5Z"/>
                        </svg>
                        <span class="side-menu__label">Form Pemesanan</span>
                    </a>
                </li>

                {{--invoice--}}
                <li class="side-item side-item-category">invoice</li>
                <li class="slide{{ $titlePage == 'Daftar Invoice' ? ' is-expanded' : '' }}">
                    <a class="side-menu__item{{ $titlePage == 'Daftar Invoice' ? ' active' : '' }}" href="{{ route('admin.invoice') }}">
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
