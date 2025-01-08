<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="shortcut icon" href="{{ asset('img/fav.png') }}" type="image/x-icon">
  <link rel="stylesheet" href="https://kit-pro.fontawesome.com/releases/v5.12.1/css/pro.min.css">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <title>Pijar Nusantara</title>
</head>

<body class="bg-gray-100">

  @include('admin.components.navbar') <!-- Navbar -->

  <div class="h-screen flex flex-row flex-wrap">
    @include('admin.components.sidebar') <!-- Sidebar -->

    @yield('content') <!-- Main content -->
  </div>

  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
  <script src="{{ asset('js/scripts.js') }}"></script>
</body>

</html>
