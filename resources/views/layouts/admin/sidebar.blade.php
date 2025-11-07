<aside class="admin-sidebar">
    <div class="brand">
        <a href="{{ url('/') }}" class="logo" aria-hidden="true"></a>
            <div>
                <div style="font-weight:700">{{ auth()->user()->name ?? config('app.name', 'Admin') }}</div>
                <div class="muted" style="font-size:0.85rem">{{ optional(auth()->user())->email ?? 'Panel Administrator' }}</div>
            </div>
    </div>

    <nav class="admin-nav">
        <ul>
            <li class="nav-section">Menu</li>
            <li>
                <a href="{{ route('admin.dashboard') ?? '#' }}" class="nav-link @if(request()->routeIs('admin.dashboard')) active @endif">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="nav-section">Data Master</li>
            <li>
                <a href="{{ route('admin.datakategori.index') }}" class="nav-link @if(request()->routeIs('admin.datakategori.*')) active @endif">
                    <i class="fas fa-list"></i>
                    <span>Kategori</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.datakategoriklinis.index') }}" class="nav-link @if(request()->routeIs('admin.datakategoriklinis.*')) active @endif">
                    <i class="fas fa-list"></i>
                    <span>Kategori Klinis</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.jenishewan.index') }}" class="nav-link @if(request()->routeIs('admin.jenishewan.*')) active @endif">
                    <i class="fas fa-paw"></i>
                    <span>Jenis Hewan</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.rashewan.index') }}" class="nav-link @if(request()->routeIs('admin.rashewan.*')) active @endif">
                    <i class="fas fa-paw"></i>
                    <span>Ras Hewan</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.manajemenrole.index') }}" class="nav-link @if(request()->routeIs('admin.manajemenrole.*')) active @endif">
                    <i class="fas fa-user-tag"></i>
                    <span>Roles</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.datauser.index') }}" class="nav-link @if(request()->routeIs('admin.datauser.*')) active @endif">
                    <i class="fas fa-users"></i>
                    <span>Users</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.datapemilik.index') }}" class="nav-link @if(request()->routeIs('admin.datapemilik.*')) active @endif">
                    <i class="fas fa-user"></i>
                    <span>Pemilik</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.datapet.index') }}" class="nav-link @if(request()->routeIs('admin.datapet.*')) active @endif">
                    <i class="fas fa-paw"></i>
                    <span>Pets</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.datarekammedis.index') }}" class="nav-link @if(request()->routeIs('admin.datarekammedis.*')) active @endif">
                    <i class="fas fa-file-medical"></i>
                    <span>Rekam Medis</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.datatindakan.index') }}" class="nav-link @if(request()->routeIs('admin.datatindakan.*')) active @endif">
                    <i class="fas fa-procedures"></i>
                    <span>Tindakan</span>
                </a>
            </li>
        </ul>
    </nav>

    <div class="sidebar-footer">
        <small class="muted">Logged in as</small>
        <div style="margin-top:6px; font-weight:700">{{ optional(auth()->user())->nama_user ?? auth()->user()->name ?? session('user_name') ?? 'Guest' }}</div>
        <div style="margin-top:8px;">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-admin ghost" style="width:100%; margin-top:8px">Logout</button>
            </form>
        </div>
    </div>
</aside>