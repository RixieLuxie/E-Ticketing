<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/logo.svg') }}">
  <link rel="icon" type="image/png" href="{{ asset('assets/logo.svg') }}">
  <title>
    Traveloke - Dashboard
  </title>
  <!-- Extra details for Live View on GitHub Pages -->
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="{{ asset ('http://e-ticketing.test/assets/dashboard/assets/css/nucleo-icons.css')}}" rel="stylesheet" />
  <link href="{{ asset ('http://e-ticketing.test/assets/dashboard/assets/css/nucleo-svg.css')}}" rel="stylesheet" />

  <link href="{{ asset ('http://e-ticketing.test/assets/icons/css/icons.css')}}" rel="stylesheet" />

  <link href="{{ asset('assets/dashboard/assets/css/nucleo-icons.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/dashboard/assets/css/nucleo-svg.css')  }}" rel="stylesheet" />

  <link href="{{ asset('assets/fontawesome/css/all.css') }}" rel="stylesheet" />

  <!-- CSS Files -->
  <link id="pagestyle" href="{{ asset ('assets/dashboard/assets/css/argon-dashboard.css?v=2.1.0') }}" rel="stylesheet" />
  <style>
    .async-hide {
      opacity: 0 !important
    }
  </style>
</head>

<body class="g-sidenav-show   bg-gray-100">
  <div class="min-height-400 bg-success position-absolute w-100"></div>
  <aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
    <div class="sidenav-header text-center">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="{{ url('/') }}">
      <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="none" viewBox="0 0 40 40"><path fill="#F06225" d="M20 0c11.046 0 20 8.954 20 20v14a6 6 0 0 1-6 6H21v-8.774c0-2.002.122-4.076 1.172-5.78a10 10 0 0 1 6.904-4.627l.383-.062a.8.8 0 0 0 0-1.514l-.383-.062a10 10 0 0 1-8.257-8.257l-.062-.383a.8.8 0 0 0-1.514 0l-.062.383a9.999 9.999 0 0 1-4.627 6.904C12.85 18.878 10.776 19 8.774 19H.024C.547 8.419 9.29 0 20 0Z"></path><path fill="#F06225" d="M0 21h8.774c2.002 0 4.076.122 5.78 1.172a10.02 10.02 0 0 1 3.274 3.274C18.878 27.15 19 29.224 19 31.226V40H6a6 6 0 0 1-6-6V21ZM40 2a2 2 0 1 1-4 0 2 2 0 0 1 4 0Z"></path></svg>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="{{ request()->routeIs('dashboard') ? 'nav-link active' : 'nav-link' }}" href="{{ route('dashboard') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa-solid fa-desktop text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        @if (Auth::user()->role == 'admin')
        <li class="nav-item">
          <a class="{{ request()->routeIs('schedule.index') ? 'nav-link active' : 'nav-link' }}" href="{{ route('schedule.index') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa-solid fa-calendar-days text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Schedule</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="{{ request()->routeIs('plane.index') ? 'nav-link active' : 'nav-link' }}" href="{{ route('plane.index') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa-solid fa-plane text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Master Plane</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="{{ request()->routeIs('airport.index') ? 'nav-link active' : 'nav-link' }}" href="{{ route('airport.index') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa-solid fa-plane-departure text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Master Airport</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="{{ request()->routeIs('airline.index') ? 'nav-link active' : 'nav-link' }}" href="{{ route('airline.index') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa-solid fa-plane-arrival text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Master Airline</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="{{ request()->routeIs('seat.index') ? 'nav-link active' : 'nav-link' }}" href="{{ route('seat.index') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa-solid fa-chair text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Master Seat</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="{{ request()->routeIs('payment.index') ? 'nav-link active' : 'nav-link' }}" href="{{ route('payment.index') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa-solid fa-money-bill text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Master Payment</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="{{ request()->routeIs('booking.index') ? 'nav-link active' : 'nav-link' }}" href="{{ route('booking.index') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa-solid fa-ticket text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Approve Bookings</span>
          </a>
        </li>
        @else
        <li class="nav-item">
          <a class="{{ request()->routeIs('order.index') ? 'nav-link active' : 'nav-link' }}" href="{{ route('order.index') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa-solid fa-cart-shopping text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Order</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="{{ request()->routeIs('booking.index') ? 'nav-link active' : 'nav-link' }}" href="{{ route('booking.index') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa-solid fa-ticket text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">My Bookings</span>
          </a>
        </li>
        @endif
      </ul>
    </div>
  </aside>
  <main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
          </ol>
          <h6 class="font-weight-bolder text-white mb-0">Welcome, {{ Auth::user()->name }}</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <ul class="navbar-nav  justify-content-end">
          </div>
          <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
            <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
              <div class="sidenav-toggler-inner">
                <i class="sidenav-toggler-line bg-white"></i>
                <i class="sidenav-toggler-line bg-white"></i>
                <i class="sidenav-toggler-line bg-white"></i>
              </div>
            </a>
          </li>
          <li class="nav-item d-flex align-items-center">
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
                </form>
                <a href="{{ route('logout') }}" class="nav-link text-white font-weight-bold px-0"
                  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  <span class="d-sm-inline d-none me-1 ">Logout</span>
                  <i class="fa-solid fa-power-off text-white opacity-10 ms-1 cursor-pointer text-sm"></i>
                </a>
              </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      @yield('content')
    </div>
  </main>
  
  <!--   Core JS Files   -->
  <script src="{{ asset ('assets/dashboard/assets/js/core/popper.min.js') }}"></script>
  <script src="{{ asset ('assets/dashboard/assets/js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset ('assets/dashboard/assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset ('assets/dashboard/assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{ asset ('assets/dashboard/assets/js/argon-dashboard.min.js?v=2.1.0') }}"></script>
  <script defer src="https://static.cloudflareinsights.com/beacon.min.js/vcd15cbe7772f49c399c6a5babf22c1241717689176015" integrity="sha512-ZpsOmlRQV6y907TI0dKBHq9Md29nnaEIPlkf84rnaERnq6zvWvPUqr2ft8M1aS28oN72PdrCzSjY4U6VaAw1EQ==" data-cf-beacon='{"rayId":"90506ccd8c78fd3a","serverTiming":{"name":{"cfExtPri":true,"cfL4":true,"cfSpeedBrain":true,"cfCacheStatus":true}},"version":"2025.1.0","token":"1b7cbb72744b40c580f8633c6b62637e"}' crossorigin="anonymous"></script>
</body>

</html>