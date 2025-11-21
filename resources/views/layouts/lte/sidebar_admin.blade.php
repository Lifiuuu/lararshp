<li class="nav-item">
  <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
    <i class="nav-icon bi bi-speedometer"></i>
    <p>Dashboard</p>
  </a>
</li>

<!-- Master Data -->
<li class="nav-item has-treeview {{ request()->routeIs('admin.datakategori.*','admin.datakategoriklinis.*','admin.jenishewan.*','admin.rashewan.*') ? 'menu-open' : '' }}">
  <a href="#" class="nav-link {{ request()->routeIs('admin.datakategori.*','admin.datakategoriklinis.*','admin.jenishewan.*','admin.rashewan.*') ? 'active' : '' }}">
    <i class="nav-icon bi bi-box-seam"></i>
    <p>
      Master Data
      <i class="right bi bi-chevron-down"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="{{ route('admin.datauser.index') }}" class="nav-link {{ request()->routeIs('admin.datauser.*') ? 'active' : '' }}">
        <i class="nav-icon bi bi-dot"></i>
        <p>Data User</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ route('admin.manajemenrole.index') }}" class="nav-link {{ request()->routeIs('admin.manajemenrole.*') ? 'active' : '' }}">
        <i class="nav-icon bi bi-dot"></i>
        <p>Role</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ route('admin.jenishewan.index') }}" class="nav-link {{ request()->routeIs('admin.jenishewan.*') ? 'active' : '' }}">
        <i class="nav-icon bi bi-dot"></i>
        <p>Jenis Hewan</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ route('admin.rashewan.index') }}" class="nav-link {{ request()->routeIs('admin.rashewan.*') ? 'active' : '' }}">
        <i class="nav-icon bi bi-dot"></i>
        <p>Ras Hewan</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ route('admin.datapemilik.index') }}" class="nav-link {{ request()->routeIs('admin.datapemilik.*') ? 'active' : '' }}">
        <i class="nav-icon bi bi-dot"></i>
        <p>Data Pemilik</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ route('admin.datapet.index') }}" class="nav-link {{ request()->routeIs('admin.datapet.*') ? 'active' : '' }}">
        <i class="nav-icon bi bi-dot"></i>
        <p>Data Pet</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ route('admin.datakategori.index') }}" class="nav-link {{ request()->routeIs('admin.datakategori.*') ? 'active' : '' }}">
        <i class="nav-icon bi bi-dot"></i>
        <p>Kategori</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ route('admin.datakategoriklinis.index') }}" class="nav-link {{ request()->routeIs('admin.datakategoriklinis.*') ? 'active' : '' }}">
        <i class="nav-icon bi bi-dot"></i>
        <p>Kategori Klinis</p>
      </a>
    </li>
  </ul>
</li>


<!-- Transaksional -->
<li class="nav-item has-treeview {{ request()->routeIs('admin.datatindakan.*','admin.datarekammedis.*') ? 'menu-open' : '' }}">
  <a href="#" class="nav-link {{ request()->routeIs('admin.datatindakan.*','admin.datarekammedis.*') ? 'active' : '' }}">
    <i class="nav-icon bi bi-hospital"></i>
    <p>
      Transaksional
      <i class="right bi bi-chevron-down"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="{{ route('admin.datarekammedis.index') }}" class="nav-link {{ request()->routeIs('admin.datarekammedis.*') ? 'active' : '' }}">
        <i class="nav-icon bi bi-dot"></i>
        <p>Rekam Medis</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ route('admin.temudokter.index') }}" class="nav-link {{ request()->routeIs('admin.temudokter.*') ? 'active' : '' }}">
        <i class="nav-icon bi bi-dot"></i>
        <p>Temu Dokter</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ route('admin.datatindakan.index') }}" class="nav-link {{ request()->routeIs('admin.datatindakan.*') ? 'active' : '' }}">
        <i class="nav-icon bi bi-dot"></i>
        <p>Data Tindakan</p>
      </a>
    </li>
  </ul>
</li>
