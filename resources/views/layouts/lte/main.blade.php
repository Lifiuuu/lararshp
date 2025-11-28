<!DOCTYPE html>
<html lang="en">
<head>
  @include('layouts.lte.head')
  <title>@yield('title', 'Dashboard') - RSHP Panel</title>
</head>
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
  <!--begin::App Wrapper-->
  <div class="app-wrapper">
    @include('layouts.lte.navbar')
    @include('layouts.lte.sidebar')
    
    <!--begin::App Main-->
    <main class="app-main">
      <!--begin::App Content Header-->
      <div class="app-content-header">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-6">
              <h3 class="mb-0">@yield('page-title', 'Dashboard')</h3>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-end">
                @yield('breadcrumb')
              </ol>
            </div>
          </div>
        </div>
      </div>
      <!--end::App Content Header-->
      
      <!--begin::App Content-->
      <div class="app-content">
        <div class="container-fluid">
          @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              {{ session('success') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @endif
          
          @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              {{ session('error') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @endif
          
          @if(session('info'))
            <div class="alert alert-info alert-dismissible fade show" role="alert">
              {{ session('info') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @endif
          
          @yield('content')
        </div>
      </div>
      <!--end::App Content-->
    </main>
    <!--end::App Main-->
    
    @include('layouts.lte.footer')
  </div>
  <!--end::App Wrapper-->
  
  @include('layouts.lte.scripts')
</body>
</html>