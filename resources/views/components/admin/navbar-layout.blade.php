<!-- start: header -->
<header class="header">
    <div class="logo-container">
        <a href="{{route('adm.dashboard')}}" class="logo">
            <img src="{{asset('template/img/logo.png')}}" width="200" height="35" alt="SIMA" />
        </a>
        <div class="d-md-none toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
            <i class="fas fa-bars" aria-label="Toggle sidebar"></i>
        </div>

    </div>

    <!-- start: search & user box -->
    <div class="header-right">

        <span class="separator"></span>

        <div id="userbox" class="userbox">
            <a href="#" data-bs-toggle="dropdown">
                <div class="profile-info" data-lock-name="John Doe" data-lock-email="johndoe@okler.com">
                    @if(Auth()->user()->role_id == "1")
                    <span class="name">Admin</span>
                    <span class="role">Administrator</span>
                    @else
                        <span class="name">Dosen</span>
                        <span class="role">Dosen</span>
                    @endif
                </div>

                <i class="fa custom-caret"></i>
            </a>

            <div class="dropdown-menu">
                <ul class="list-unstyled mb-2">
                    <li class="divider"></li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                    <li>
                        <a role="menuitem" tabindex="-1" href="{{route('logout')}}"  onclick="event.preventDefault();
                                                this.closest('form').submit();"><i class="bx bx-power-off"></i> Logout</a>
                    </li>
                    </form>
                </ul>
            </div>
        </div>
    </div>
    <!-- end: search & user box -->
</header>
<!-- end: header -->
