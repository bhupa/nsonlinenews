<div class="navbar-brand">
    <a href="index.html" class="d-inline-block">
        <img src="global_assets/images/logo_light.png" alt="">
    </a>
</div>

<div class="d-md-none">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
        <i class="icon-tree5"></i>
    </button>
    <button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
        <i class="icon-paragraph-justify3"></i>
    </button>
</div>

<div class="collapse navbar-collapse" id="navbar-mobile">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a href="#" class="navbar-nav-link sidebar-control sidebar-main-toggle d-none d-md-block">
                <i class="icon-paragraph-justify3"></i>
            </a>
        </li>

    </ul>
    <span class="navbar-text ml-md-3 mr-md-auto">
				<span class="badge bg-success">Online</span>
			</span>
    @if (Auth::check())
        <ul class="navbar-nav">



            <li class="nav-item dropdown dropdown-user">
                <a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown">
                    <!-- <img src="../../../../global_assets/images/placeholders/placeholder.jpg" class="rounded-circle" alt=""> -->
                    <span> {{ucfirst($user->username)}}</span>

                </a>

                <div class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item"><i class="icon-cog5"></i> Account settings</a>
                    <a href="#" class="dropdown-item"><i class="icon-pencil4"></i> Change Password</a>
                    <a href="{{route('logout')}}" class="dropdown-item"><i class="icon-switch2"></i> Logout</a>
                </div>
            </li>
        </ul>
    @endif
</div>