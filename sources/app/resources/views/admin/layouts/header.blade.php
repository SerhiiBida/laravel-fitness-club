<header class="header">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-lg">
            <a class="navbar-brand" href="#">
                Admin Panel
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
                    aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon">
                </span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                @includeIf('admin.layouts.menu')

                @auth
                    <a class="btn btn-outline-dark" href="{{ route('admin.logout') }}">
                        Log out
                    </a>
                @endauth

                @guest
                    <span class="navbar-text">
                        Fitness Club
                    </span>
                @endguest
            </div>
        </div>
    </nav>
</header>
