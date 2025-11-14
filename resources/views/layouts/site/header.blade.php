<header class="navbar">
    <div class="container">
        <a href="{{ Route::has('home') ? route('home') : url('/') }}" class="logo">
            RSHP Universitas Airlangga
        </a>

        <nav>
            <ul>
                <li><a href="{{ Route::has('home') ? route('home') : url('/') }}" class="nav-link {{ request()->is('/') ? 'active' : '' }}">Home</a></li>
                <li><a href="{{ Route::has('struktur-organisasi') ? route('struktur-organisasi') : url('/struktur-organisasi') }}" class="nav-link {{ request()->is('struktur-organisasi*') ? 'active' : '' }}">Struktur Organisasi</a></li>
                <li><a href="{{ Route::has('layanan-umum') ? route('layanan-umum') : url('/layanan-umum') }}" class="nav-link {{ request()->is('layanan-umum*') ? 'active' : '' }}">Layanan Umum</a></li>
                <li><a href="{{ Route::has('visi-misi-tujuan') ? route('visi-misi-tujuan') : url('/visi-misi-dan-tujuan') }}" class="nav-link {{ request()->is('visi-misi*') ? 'active' : '' }}">Visi Misi &amp; Tujuan</a></li>

                {{-- Right-side: auth links --}}
                @guest
                    @if (Route::has('login'))
                        <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                    @endif
                    @if (Route::has('register'))
                        <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>
                    @endif
                @else
                    <li class="muted" style="display:flex; align-items:center; gap:8px">
                        <span style="font-weight:700;">{{ Auth::user()->name }}</span>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:inline">
                            @csrf
                            <button type="submit" class="btn btn-link">{{ __('Logout') }}</button>
                        </form>
                    </li>
                @endguest
            </ul>
        </nav>
    </div>
</header>
