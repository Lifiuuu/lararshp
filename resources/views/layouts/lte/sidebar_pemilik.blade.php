<li class="nav-item">
  <a href="{{ route('pemilik.dashboard') }}" class="nav-link {{ request()->routeIs('pemilik.dashboard') ? 'active' : '' }}">
    <i class="nav-icon bi bi-speedometer"></i>
    <p>Dashboard</p>
  </a>
</li>
<li class="nav-item">
  <a href="{{ route('pemilik.pet.index') }}" class="nav-link {{ request()->routeIs('pemilik.pet.*') ? 'active' : '' }}">
    <i class="nav-icon bi bi-paw"></i>
    <p>My Pets</p>
  </a>
</li>
<li class="nav-item">
  <a href="{{ route('pemilik.rekammedis.index') }}" class="nav-link {{ request()->routeIs('pemilik.rekammedis.*') ? 'active' : '' }}">
    <i class="nav-icon bi bi-file-medical"></i>
    <p>Rekam Medis</p>
  </a>
</li>
