<!--begin::Header-->
<nav class="app-header navbar navbar-expand bg-body">
  <!--begin::Container-->
  <div class="container-fluid">
    <!--begin::Start Navbar Links-->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
          <i class="bi bi-list"></i>
        </a>
      </li>
      @if(session('user_role') == 1)
        <!-- Admin Menu -->
        <li class="nav-item"><a href="{{ route('admin.dashboard') }}" class="nav-link">Dashboard</a></li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="adminDataDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Data Master
          </a>
          <ul class="dropdown-menu" aria-labelledby="adminDataDropdown">
            <li><a class="dropdown-item" href="{{ route('admin.datauser.index') }}">Data User</a></li>
            <li><a class="dropdown-item" href="{{ route('admin.datadokter.index') }}">Data Dokter</a></li>
            <li><a class="dropdown-item" href="{{ route('admin.dataperawat.index') }}">Data Perawat</a></li>
            <li><a class="dropdown-item" href="{{ route('admin.datapemilik.index') }}">Data Pemilik</a></li>
            <li><a class="dropdown-item" href="{{ route('admin.datapet.index') }}">Data Pet</a></li>
            <li><a class="dropdown-item" href="{{ route('admin.datarekammedis.index') }}">Data Rekam Medis</a></li>
            <li><a class="dropdown-item" href="{{ route('admin.datatindakan.index') }}">Data Tindakan</a></li>
            <li><a class="dropdown-item" href="{{ route('admin.temudokter.index') }}">Temu Dokter</a></li>
          </ul>
        </li>
      @elseif(session('user_role') == 2)
        <!-- Dokter Menu -->
        <li class="nav-item"><a href="{{ route('dokter.dashboard') }}" class="nav-link">Dashboard</a></li>
        <li class="nav-item"><a href="{{ route('dokter.datarekammedis.index') }}" class="nav-link">Data Rekam Medis</a></li>
      @elseif(session('user_role') == 3)
        <!-- Perawat Menu -->
        <li class="nav-item"><a href="{{ route('perawat.dashboard') }}" class="nav-link">Dashboard</a></li>
        <li class="nav-item"><a href="{{ route('perawat.datarekammedis.index') }}" class="nav-link">Data Rekam Medis</a></li>
      @elseif(session('user_role') == 4)
        <!-- Resepsionis Menu -->
        <li class="nav-item"><a href="{{ route('resepsionis.dashboard') }}" class="nav-link">Dashboard</a></li>
        <li class="nav-item"><a href="{{ route('resepsionis.datapemilik.index') }}" class="nav-link">Data Pemilik</a></li>
        <li class="nav-item"><a href="{{ route('resepsionis.datapet.index') }}" class="nav-link">Data Pet</a></li>
        <li class="nav-item"><a href="{{ route('resepsionis.temudokter.index') }}" class="nav-link">Temu Dokter</a></li>
      @elseif(session('user_role') == 5)
        <!-- Pemilik Menu -->
        <li class="nav-item"><a href="{{ route('pemilik.dashboard') }}" class="nav-link">Dashboard</a></li>
        <li class="nav-item"><a href="{{ route('pemilik.pet.index') }}" class="nav-link">Data Pet</a></li>
        <li class="nav-item"><a href="{{ route('pemilik.rekammedis.index') }}" class="nav-link">Rekam Medis</a></li>
      @endif
    </ul>
    <!--end::Start Navbar Links-->
    <!--begin::End Navbar Links-->
    <ul class="navbar-nav ms-auto">
      <!--begin::Navbar Search-->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="bi bi-search"></i>
        </a>
      </li>
      <!--end::Navbar Search-->
      <!--begin::Fullscreen Toggle-->
      <li class="nav-item">
        <a class="nav-link" href="#" data-lte-toggle="fullscreen">
          <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
          <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none"></i>
        </a>
      </li>
      <!--end::Fullscreen Toggle-->
      <!--begin::User Menu Dropdown-->
      <li class="nav-item dropdown user-menu">
        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
          <img src="{{ asset('assets/img/user2-160x160.jpg') }}" class="user-image rounded-circle shadow" alt="User Image" />
          <span class="d-none d-md-inline">{{ session('user_name', 'User') }}</span>
        </a>
        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
          <li class="user-header text-bg-primary">
            <img src="{{ asset('assets/img/user2-160x160.jpg') }}" class="rounded-circle shadow" alt="User Image" />
            <p>
              {{ session('user_name', 'User') }}
              <small>
                @if(session('user_role') == 1) Administrator
                @elseif(session('user_role') == 2) Dokter
                @elseif(session('user_role') == 3) Perawat
                @elseif(session('user_role') == 4) Resepsionis
                @elseif(session('user_role') == 5) Pemilik
                @else Member
                @endif
              </small>
            </p>
          </li>
          <li class="user-body">
            <div class="row">
              <div class="col-12 text-center">
                <p>Selamat datang di Sistem Klinik Veteriner</p>
              </div>
            </div>
          </li>
          <li class="user-footer">
            <div class="d-flex gap-2">
              <div class="flex-fill">
                @if(session('user_role') == 2)
                  <a href="{{ route('dokter.profile.edit') }}" class="btn btn-default btn-flat w-100">Profile</a>
                @elseif(session('user_role') == 3)
                  <a href="{{ route('perawat.profile.edit') }}" class="btn btn-default btn-flat w-100">Profile</a>
                @elseif(session('user_role') == 5)
                  <a href="{{ route('pemilik.profile.edit') }}" class="btn btn-default btn-flat w-100">Profile</a>
                @else
                  <a href="#" class="btn btn-default btn-flat w-100">Profile</a>
                @endif
              </div>
              <div class="flex-fill">
                <form action="{{ route('logout') }}" method="POST" class="m-0">
                  @csrf
                  <button type="submit" class="btn btn-default btn-flat w-100">Sign out</button>
                </form>
              </div>
            </div>
          </li>
        </ul>
      </li>
      <!--end::User Menu Dropdown-->
    </ul>
    <!--end::End Navbar Links-->
  </div>
  <!--end::Container-->
</nav>
<!--end::Header-->