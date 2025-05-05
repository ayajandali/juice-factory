<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>@yield('title', 'Admin Dashboard')</title>

  <!-- AdminLTE CSS -->
  <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.2/css/all.min.css">

  @yield('styles')
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  @include('layouts.admin-navbar')
  @include('layouts.admin-sidebar')

  <!-- Content Wrapper -->
  <div class="content-wrapper">
    <section class="content pt-4 px-3">
        @yield('content')
    </section>
  </div>

  @include('layouts.admin-footer')
</div>

<!-- AdminLTE JS -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>

@yield('scripts')
</body>
</html>
