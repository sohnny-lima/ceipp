<header class="app-header">
    <a href="{{ url('/') }}" class="brand">CEIPP</a>
    <div class="user-area">
        @auth
            <span>{{ auth()->user()->name }}</span>
            <form method="POST" action="{{ url('/logout') }}">
                @csrf
                <button type="submit" class="logout-button">Cerrar sesi&#243;n</button>
            </form>
        @else
            <span>Invitado</span>
        @endauth
    </div>
</header>
