<footer class="footer bg-dark text-white">
    <div class="container">
        <footer class="py-3 my-4">
            <ul class="nav justify-content-center border-bottom pb-3 mb-3">
                @auth
                    <li class="nav-item">
                        <a href="#" class="nav-link px-2 text-white">
                            Dashboard
                        </a>
                    </li>
                @endauth
            </ul>
            <p class="text-center text-white">
                © 2024 Fitness Club, Inc
            </p>
        </footer>
    </div>
</footer>
