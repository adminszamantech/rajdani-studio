<!DOCTYPE html>
<html lang="en">
  <head>
    @include('admin.layouts.head')
  </head>
  <body>
    <div class="container-scroller">
      <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        @include('admin.layouts.navbar')
      </nav>
      <div class="container-fluid page-body-wrapper">
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            @include('admin.layouts.sidebar')
        </nav>
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">
                @stack('admin_breadcumb')
              </h3>
            </div>
            @yield('admin_content')
          </div>
          <footer class="footer">
            @include('admin.layouts.footer')
          </footer>
        </div>
      </div>
    </div>
    @include('admin.layouts.scripts')
  </body>
</html>
