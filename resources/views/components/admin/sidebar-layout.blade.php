<aside id="sidebar-left" class="sidebar-left">

    <div class="nano">
        <div class="nano-content">
            <nav id="menu" class="nav-main" role="navigation">

                <ul class="nav nav-main">
                    <li>
                        <a href="layouts-default.html">
                            <i class="bx bx-home-alt" aria-hidden="true"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-parent">
                        <a href="#">
                            <i class="bx bx-cart-alt" aria-hidden="true"></i>
                            <span>Master Data</span>
                        </a>
                        <ul class="nav nav-children">
                            <li>
                                <a href="ecommerce-dashboard.html">
                                    Users
                                </a>
                            </li>
                            <li>
                                <a href="ecommerce-products-list.html">
                                    Data Penyusunan Skripsi [S]
                                </a>
                            </li>
                            <li>
                                <a href="ecommerce-products-list.html">
                                    Data Kriteria Penyusunan Skripsi [K]
                                </a>
                            </li>
                            <li>
                                <a href="ecommerce-products-list.html">
                                    Basis Pengetahuan
                                </a>
                            </li>
                            <li>
                                <a href="ecommerce-products-list.html">
                                    Rule
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
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
