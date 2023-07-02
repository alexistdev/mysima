<aside id="sidebar-left" class="sidebar-left">

    <div class="nano">
        <div class="nano-content">
            <nav id="menu" class="nav-main" role="navigation">
                @if(Auth()->user()->role_id  == "1")
                    <ul class="nav nav-main">
                        <li @if($menuUtama == "dashboard") class="nav-active" @endif>
                            <a href="{{route('adm.dashboard')}}">
                                <i class="bx bx-home-alt" aria-hidden="true"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <li class="nav-parent @if($menuUtama == "master") nav-active  nav-expanded @endif">
                            <a href="#">
                                <i class="bx bx-spreadsheet" aria-hidden="true"></i>
                                <span>Master Data</span>
                            </a>
                            <ul class="nav nav-children">
                                <li @if($menuKedua == "mapel") class="nav-active" @endif>
                                    <a href="{{route('adm.mapel')}}">
                                        Data Mata Pelajaran
                                    </a>
                                </li>
                                <li @if($menuKedua == "dosen") class="nav-active" @endif>
                                    <a href="{{route('adm.dosen')}}">
                                        Data Dosen
                                    </a>
                                </li>
                                <li @if($menuKedua == "mahasiswa") class="nav-active" @endif>
                                    <a href="{{route('adm.mahasiswa')}}">
                                        Data Mahasiswa
                                    </a>
                                </li>
                                <li @if($menuKedua == "criteria") class="nav-active" @endif>
                                    <a href="{{route('adm.criteria')}}">
                                        Kriteria Penyusunan Skripsi [K]
                                    </a>
                                </li>
{{--                                <li>--}}
{{--                                    <a href="ecommerce-products-list.html">--}}
{{--                                        Basis Pengetahuan--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                                <li>--}}
{{--                                    <a href="ecommerce-products-list.html">--}}
{{--                                        Rule--}}
{{--                                    </a>--}}
{{--                                </li>--}}
                            </ul>
                        </li>

                    </ul>
                @endif
                @if(Auth()->user()->role_id  == "2")
                        <ul class="nav nav-main">
                            <li @if($menuUtama == "dashboard") class="nav-active" @endif>
                                <a href="{{route('dosen.dashboard')}}">
                                    <i class="bx bx-home-alt" aria-hidden="true"></i>
                                    <span>Dashboard</span>
                                </a>
                            </li>
                            <li @if($menuUtama == "inputNilai") class="nav-active" @endif>
                                <a href="{{route('dosen.nilai')}}">
                                    <i class="bx bx-food-menu" aria-hidden="true"></i>
                                    <span>Input Nilai</span>
                                </a>
                            </li>
                        </ul>
                @endif
            </nav>

        </div>

        <script>
            // Maintain Scroll Position
            if (typeof localStorage !== 'undefined') {
                if (localStorage.getItem('sidebar-left-position') !== null) {
                    var initialPosition = localStorage.getItem('sidebar-left-position'),
                        sidebarLeft = document.querySelector('#sidebar-left .nano-content');

                    sidebarLeft.scrollTop = initialPosition;
                }
            }
        </script>

    </div>

</aside>
