@vite(['resources/css/app.css', 'resources/js/app.js'])

<nav class="navbar">
    <div class="nav-logo">PostApp</div>

    <ul class="nav-links">
        @guest
            <li><a href="/">Inicio</a></li>
        @endguest
        <li><a href="/post">Posts</a></li>

        @guest
            <li><a href="/log_in">Login</a></li>
            <li><a href="/sign_up" class="nav-btn">Registro</a></li>
        @endguest

        @auth
            <li><a href="/profile">Perfil</a></li>
            @if (auth()->user()->rol_id == 3 || auth()->user()->rol_id == 2)
                <li><a href="/admin" class="nav-btn">Admin Panel</a></li>
                
            @endif
            <li><a href="/log_out" class="nav-btn">Cerrar sesión</a></li>
            
        @endauth
    </ul>
</nav>