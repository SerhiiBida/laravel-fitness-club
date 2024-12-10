<ul class="navbar-nav me-auto mb-2 mb-lg-0">
    @auth
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{ route('admin.dashboard') }}">
                Dashboard
            </a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
               aria-expanded="false">
                Users
            </a>
            <ul class="dropdown-menu">
                @if (in_array('view users', $permissions))
                    <li>
                        <a class="dropdown-item" href="{{ route('admin.users.index') }}">
                            Users
                        </a>
                    </li>
                @endif
                @if (in_array('view roles', $permissions))
                    <li>
                        <a class="dropdown-item" href="{{ route('admin.roles.index') }}">
                            Roles
                        </a>
                    </li>
                @endif
            </ul>
        </li>
    @endauth
</ul>
