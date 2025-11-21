<li class="nav-item">
  <a href="{{ route('dokter.dashboard') }}" class="nav-link {{ request()->routeIs('dokter.dashboard') ? 'active' : '' }}">
    <i class="nav-icon bi bi-speedometer"></i>
    <p>Dashboard</p>
  </a>
</li>
<li class="nav-item">
  <a href="{{ route('dokter.datarekammedis.index') }}" class="nav-link {{ request()->routeIs('dokter.datarekammedis.*') ? 'active' : '' }}">
    <i class="nav-icon bi bi-file-medical"></i>
    <p>Rekam Medis</p>
  </a>
</li>
<li class="nav-item">
  <a href="{{ route('dokter.datatindakan.index') }}" class="nav-link {{ request()->routeIs('dokter.datatindakan.*') ? 'active' : '' }}">
    <i class="nav-icon bi bi-procedures"></i>
    <p>Tindakan</p>
  </a>
</li>
