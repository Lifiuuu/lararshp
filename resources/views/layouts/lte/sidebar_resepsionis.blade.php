<li class="nav-item">
  <a href="{{ route('resepsionis.dashboard') }}" class="nav-link {{ request()->routeIs('resepsionis.dashboard') ? 'active' : '' }}">
    <i class="nav-icon bi bi-speedometer"></i>
    <p>Dashboard</p>
  </a>
</li>
<li class="nav-item">
  <a href="{{ route('resepsionis.datapemilik.index') }}" class="nav-link {{ request()->routeIs('resepsionis.datapemilik.*') ? 'active' : '' }}">
    <i class="nav-icon bi bi-people-fill"></i>
    <p>Data Pemilik</p>
  </a>
</li>
<li class="nav-item">
  <a href="{{ route('resepsionis.datapet.index') }}" class="nav-link {{ request()->routeIs('resepsionis.datapet.*') ? 'active' : '' }}">
    <i class="nav-icon bi bi-paw"></i>
    <p>Data Pet</p>
  </a>
</li>
<li class="nav-item">
  <a href="{{ route('resepsionis.temudokter.index') }}" class="nav-link {{ request()->routeIs('resepsionis.temudokter.*') ? 'active' : '' }}">
    <i class="nav-icon bi bi-calendar-check"></i>
    <p>Temu Dokter</p>
  </a>
</li>
