@vite(['resources/css/app.css', 'resources/js/app.js'])

<nav class="navbar">
    <div class="nav-logo">PostApp</div>

    <ul class="nav-links">
        <li><a href="/post">Posts</a></li>

        @guest
            <li><a href="/log_in">Login</a></li>
            <li><a href="/sign_up" class="nav-btn">Registro</a></li>
        @endguest

        @auth
            <li><a href="/profile">Perfil</a></li>
            <li><a href="/log_out" class="nav-btn">Cerrar sesión</a></li>
        @endauth
    </ul>
</nav>