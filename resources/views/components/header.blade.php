<div style="background: #333; padding: 15px; display: flex; gap: 15px; align-items: center;">
    <a href="/" style="color: white; text-decoration: none;">Főoldal</a>
    <a href="/adatbazis" style="color: white; text-decoration: none;">Adatbázis</a>
    <a href="/kapcsolat" style="color: white; text-decoration: none;">Kapcsolat</a>
    <a href="/diagram" style="color: white; text-decoration: none;">Diagram</a>

    {{-- Ha be van jelentkezve --}}
    @if (Auth::check())
        <a href="/dashboard" style="color: white; text-decoration: none;">Dashboard</a>
        
        {{-- Csak admin láthatja a CRUD / kezelő felületet --}}
        @if (Auth::user()->role == 1)
            <a href="/gepek" style="color: white; text-decoration: none; color: #ffeb3b;">Notebook CRUD (Admin)</a>
        @endif

        <form method="POST" action="/logout" style="display:inline; margin-left: auto;">
            @csrf
            <button type="submit" style="background: red; color: white; border: none; padding: 5px 10px; cursor: pointer;">Kijelentkezés</button>
        </form>
    @else
        {{-- Ha vendég --}}
        <a href="/login" style="color: white; text-decoration: none; margin-left: auto;">Bejelentkezés</a>
        <a href="/register" style="color: white; text-decoration: none;">Regisztráció</a>
    @endif
</div>