
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/logo.svg') }}">
  <link rel="icon" type="image/png" href="{{ asset('assets/logo.svg') }}">
  <title>
    Traveloke - Login
  </title>
  <link id="pagestyle" href="{{ asset ('assets/dashboard/assets/css/argon-dashboard.css?v=2.1.0') }}" rel="stylesheet" />
</head>
  <div class="container position-sticky z-index-sticky top-0">
    <div class="row">
      <div class="col-12">
      </div>
    </div>
  </div>
  <main class="main-content  mt-0">
    <section>
      <div class="page-header min-vh-100" style="background-image: url('{{ asset('assets/bg-login.jpg') }}');">
        <div class="container">
          <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
              <div class="card card-plain">
                <div class="card-header pb-0 text-start bg-transparent">
                  <h4 class="font-weight-bolder">Sign In</h4>
                  <p class="mb-0">Enter your username and password to sign in</p>
                </div>
                <div class="card-body rounded-3">
                  @yield('content')
                </div>
                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                  <p class="mb-4 text-sm mx-auto">
                    Don't have an account?
                    <a href="{{ route('register') }}" class="text-primary text-gradient font-weight-bold">Sign up</a>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
              <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden" style="background-image: url('{{ asset('assets/background-login.jpeg') }}');
          background-size: cover;">
                <span class="mask bg-gradient-dark opacity-6"></span>
                <h4 class="mt-5 text-white font-weight-bolder position-relative">E-Ticketing</h4>
                <p class="text-white position-relative">Empowering Your Journeys with Seamless Ticketing Solutions, Anytime and Anywhere.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

</body>

</html>