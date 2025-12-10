<!--begin::Sidebar-->
@php $role = session('user_role', null); @endphp
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
  <!--begin::Sidebar Brand-->
  <div class="sidebar-brand">
    @if($role == 1)
      <a href="{{ route('admin.dashboard') }}" class="brand-link">
        <img src="https://arsip.unair.ac.id/wp-content/uploads/2019/01/logo-unair.png" alt="Logo" class="brand-image opacity-75 shadow" />
        <span class="brand-text fw-light">RSHP Panel</span>
      </a>
    @elseif($role == 2)
      <a href="{{ route('dokter.dashboard') }}" class="brand-link">
        <img src="https://arsip.unair.ac.id/wp-content/uploads/2019/01/logo-unair.png" alt="Logo" class="brand-image opacity-75 shadow" />
        <span class="brand-text fw-light">RSHP Dokter</span>
      </a>
    @elseif($role == 3)
      <a href="{{ route('perawat.dashboard') }}" class="brand-link">
        <img src="https://arsip.unair.ac.id/wp-content/uploads/2019/01/logo-unair.png" alt="Logo" class="brand-image opacity-75 shadow" />
        <span class="brand-text fw-light">RSHP Perawat</span>
      </a>
    @elseif($role == 4)
      <a href="{{ route('resepsionis.dashboard') }}" class="brand-link">
        <img src="https://arsip.unair.ac.id/wp-content/uploads/2019/01/logo-unair.png" alt="Logo" class="brand-image opacity-75 shadow" />
        <span class="brand-text fw-light">RSHP Resepsionis</span>
      </a>
    @elseif($role == 5)
      <a href="{{ route('pemilik.dashboard') }}" class="brand-link">
        <img src="https://arsip.unair.ac.id/wp-content/uploads/2019/01/logo-unair.png" alt="Logo" class="brand-image opacity-75 shadow" />
        <span class="brand-text fw-light">RSHP Pemilik</span>
      </a>
    @else
      <a href="{{ route('home') }}" class="brand-link">
        <img src="https://arsip.unair.ac.id/wp-content/uploads/2019/01/logo-unair.png" alt="Logo" class="brand-image opacity-75 shadow" />
        <span class="brand-text fw-light">RSHP</span>
      </a>
    @endif
  </div>
  <!--end::Sidebar Brand-->

  <!--begin::Sidebar Wrapper-->
  <div class="sidebar-wrapper">
    <nav class="mt-2">
      <!--begin::Sidebar Menu-->
      <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="navigation" aria-label="Main navigation" data-accordion="false" id="navigation">

        @if($role == 1)
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
              <a href="{{ route('admin.datadokter.index') }}" class="nav-link {{ request()->routeIs('admin.datadokter.*') ? 'active' : '' }}">
                <i class="nav-icon bi bi-dot"></i>
                <p>Data Dokter</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.dataperawat.index') }}" class="nav-link {{ request()->routeIs('admin.dataperawat.*') ? 'active' : '' }}">
                <i class="nav-icon bi bi-dot"></i>
                <p>Data Perawat</p>
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
              <a href="{{ route('admin.temudokter.index') }}" class="nav-link {{ request()->routeIs('admin.temudokter.*') ? 'active' : '' }}">
                <i class="nav-icon bi bi-dot"></i>
                <p>Temu Dokter</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.datarekammedis.index') }}" class="nav-link {{ request()->routeIs('admin.datarekammedis.*') ? 'active' : '' }}">
                <i class="nav-icon bi bi-dot"></i>
                <p>Rekam Medis</p>
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
        @endif

        @if($role == 2)
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
        @endif

        @if($role == 3)
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
        @endif

        @if($role == 4)
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
        @endif

        @if($role == 5)
        <li class="nav-item">
          <a href="{{ route('pemilik.dashboard') }}" class="nav-link {{ request()->routeIs('pemilik.dashboard') ? 'active' : '' }}">
            <i class="nav-icon bi bi-speedometer"></i>
            <p>Dashboard</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('pemilik.pet.index') }}" class="nav-link {{ request()->routeIs('pemilik.pet.*') ? 'active' : '' }}">
            <i class="nav-icon bi bi-heart"></i>
            <p>My Pets</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('pemilik.rekammedis.index') }}" class="nav-link {{ request()->routeIs('pemilik.rekammedis.*') ? 'active' : '' }}">
            <i class="nav-icon bi bi-file-medical"></i>
            <p>Rekam Medis</p>
          </a>
        </li>
        @endif

        @if(!in_array($role, [1,2,3,4,5]))
          <li class="nav-item">
            <a href="{{ route('home') }}" class="nav-link">
              <i class="nav-icon bi bi-house"></i>
              <p>Home</p>
            </a>
          </li>
        @endif

      </ul>
      <!--end::Sidebar Menu-->
    </nav>
  </div>
  <!--end::Sidebar Wrapper-->
</aside>
<!--end::Sidebar-->
