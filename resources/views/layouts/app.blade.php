<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>App Name - @yield('title')</title>
  <!-- Favicon -->
  <link href="/img/brand/favicon.png" rel="icon" type="image/png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
  <link href="/vendor/nucleo/css/nucleo.css" rel="stylesheet">
  <link href="/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
  <!-- Argon CSS -->
  <link type="text/css" href="/css/argon.css?v=1.0.0" rel="stylesheet">
</head>

<body>
  <!-- NAVBAR -->
  @include('includes.nav')
  <!-- Main content -->
  <div class="main-content">
    @include('includes.top-nav-bar')
    <!-- Header -->
    @include('includes.header')

    <div class="container-fluid mt--7">

      <!-- CONTENT -->
      @yield('content')

      <!-- Footer -->
      <footer class="footer">
        <div class="row align-items-center justify-content-xl-between">
          <div class="col-xl-6">
            <div class="copyright text-center text-xl-left text-muted">
              &copy; 2019 Laracepta
            </div>
          </div>

        </div>
      </footer>
    </div>
  </div>
  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="/vendor/jquery/dist/jquery.min.js"></script>
  <script src="/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Argon JS -->
  <script src="/js/argon.js?v=1.0.0"></script>
</body>

</html>
