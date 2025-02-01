<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/logo.svg') }}">
  <link rel="icon" type="image/png" href="{{ asset('assets/logo.svg') }}">
  <title>
    Traveloke - Register
  </title>
  <link id="pagestyle" href="{{ asset ('assets/dashboard/assets/css/argon-dashboard.css?v=2.1.0') }}" rel="stylesheet" />
</head>

<body>


    <main class="main-content  mt-0">
        <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg" style="background-image: url('{{ asset ('assets/background-register.jpg') }}')">
            <span class="mask bg-gradient-dark opacity-7"></span>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5 text-center mx-auto">
                        <h1 class="text-white mb-2 mt-5">Welcome!</h1>
                        <p class="text-lead text-white">Your Gateway to Unforgettable Experiences Starts Here!</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row mt-lg-n10 mt-md-n11 mt-n10 justify-content-center">
                <div class="col-xl-5 col-lg-5 col-md-7 mx-auto">
                    <div class="card z-index-0">
                        <div class="card-header text-center pt-4">
                            <h5>Register with</h5>
                        </div>
                        <div class="card-body">
                                @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="assets/dashboard/assets/js/core/popper.min.js"></script>
    <script src="assets/dashboard/assets/js/core/bootstrap.min.js"></script>
    <script src="assets/dashboard/assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="assets/dashboard/assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="assets/dashboard/assets/js/argon-dashboard.min.js?v=2.1.0"></script>
</body>

</html>