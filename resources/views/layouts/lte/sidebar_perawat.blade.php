<li class="nav-item">
  <a href="{{ route('perawat.dashboard') }}" class="nav-link {{ request()->routeIs('perawat.dashboard') ? 'active' : '' }}">
    <i class="nav-icon bi bi-speedometer"></i>
    <p>Dashboard</p>
  </a>
</li>
<li class="nav-item">
  <a href="{{ route('perawat.datarekammedis.index') }}" class="nav-link {{ request()->routeIs('perawat.datarekammedis.*') ? 'active' : '' }}">
    <i class="nav-icon bi bi-file-medical"></i>
    <p>Rekam Medis</p>
  </a>
</li>