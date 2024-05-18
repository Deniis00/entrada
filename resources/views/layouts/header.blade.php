<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav ml-auto">
        <?php
        
        if (Auth::user()->url_foto == null) {
            $photo = 'assets/images/profile/male.png';
        } else {
            $photo = Auth::user()->url_foto;
        }
        ?>
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle profile-pic login_profile p-0" data-toggle="dropdown" href="#">
                <img src="{{ asset($photo) }}" alt="user-img" width="36" class="img-circle">
                <b id="ambitious-user-name-id" class="hidden-xs">{{ strtok(Auth::user()->name, ' ') }}</b>
                <span class="caret"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <a href="#" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                        <img src="{{ asset($photo) }}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                        <div class="media-body">
                            <h4 class="dropdown-item-title">
                                {{ strtok(Auth::user()->username, ' ') }}
                                <span class="caret"></span>
                            </h4>
                            <p class="text-muted" class="custom-padding-bottom-5">
                                {{ \Illuminate\Support\Str::limit(Auth::user()->email, 17) }}</p>

                        </div>
                    </div>
                    <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{ route('profile.password') }}" class="dropdown-item">
                    <i class="fa fa-key mr-2"></i></i> {{ __('Change Password') }}
                </a>

                @if (Auth::user() && Auth::user()->hasRole('Admin'))
                    <a href="{{ route('users.create') }}" class="dropdown-item">
                        <i class="fa fa-user-plus mr-2"></i></i> Agregar usuario
                    </a>
                @endif
                <div class="dropdown-divider"></div>
                <a id="header-logout" href="{{ route('logout') }}" class="dropdown-item"><i
                        class="fa fa-power-off mr-2"></i> {{ __('Logout') }}</a>
                <form id="logout-form" class="ambitious-display-none" action="{{ route('logout') }}" method="POST">
                    @csrf</form>

            </div>
        </li>
    </ul>

</nav>

<script src="{{ asset('assets/js/custom/layouts/header.js') }}"></script>
