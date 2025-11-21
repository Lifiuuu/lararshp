<!--begin::Sidebar-->
@php $role = session('user_role', null); @endphp
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
  <!--begin::Sidebar Brand-->
  <div class="sidebar-brand">
    @if($role == 1)
      <a href="{{ route('admin.dashboard') }}" class="brand-link">
        <img src="{{ asset('assets/img/AdminLTELogo.png') }}" alt="Logo" class="brand-image opacity-75 shadow" />
        <span class="brand-text fw-light">RSHP Panel</span>
      </a>
    @elseif($role == 2)
      <a href="{{ route('dokter.dashboard') }}" class="brand-link">
        <img src="{{ asset('assets/img/AdminLTELogo.png') }}" alt="Logo" class="brand-image opacity-75 shadow" />
        <span class="brand-text fw-light">RSHP Dokter</span>
      </a>
    @elseif($role == 3)
      <a href="{{ route('perawat.dashboard') }}" class="brand-link">
        <img src="{{ asset('assets/img/AdminLTELogo.png') }}" alt="Logo" class="brand-image opacity-75 shadow" />
        <span class="brand-text fw-light">RSHP Perawat</span>
      </a>
    @elseif($role == 4)
      <a href="{{ route('resepsionis.dashboard') }}" class="brand-link">
        <img src="{{ asset('assets/img/AdminLTELogo.png') }}" alt="Logo" class="brand-image opacity-75 shadow" />
        <span class="brand-text fw-light">RSHP Resepsionis</span>
      </a>
    @elseif($role == 5)
      <a href="{{ route('pemilik.dashboard') }}" class="brand-link">
        <img src="{{ asset('assets/img/AdminLTELogo.png') }}" alt="Logo" class="brand-image opacity-75 shadow" />
        <span class="brand-text fw-light">RSHP Pemilik</span>
      </a>
    @else
      <a href="{{ route('home') }}" class="brand-link">
        <img src="{{ asset('assets/img/AdminLTELogo.png') }}" alt="Logo" class="brand-image opacity-75 shadow" />
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

        @includeWhen($role == 1, 'layouts.lte.sidebar_admin')
        @includeWhen($role == 2, 'layouts.lte.sidebar_dokter')
        @includeWhen($role == 3, 'layouts.lte.sidebar_perawat')
        @includeWhen($role == 4, 'layouts.lte.sidebar_resepsionis')
        @includeWhen($role == 5, 'layouts.lte.sidebar_pemilik')

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
