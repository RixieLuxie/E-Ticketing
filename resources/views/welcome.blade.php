<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/logo.svg') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/logo.svg') }}">
    <title>
        Traveloke
    </title>
    <link id="pagestyle" href="{{ asset('assets/dashboard/assets/css/argon-dashboard.css?v=2.1.0') }}"
        rel="stylesheet" />
    <link href="{{ asset('assets/fontawesome/css/all.css') }}" rel="stylesheet" />
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('login') }}"><img src="{{ asset('assets/logo.svg') }}" alt=""
                    class="mx-4"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <i class="fa-solid fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-bold" href="#booking">Bookings</a>
                    </li>
                </ul>
                <ul class="navbar-nav mt-2">
                    <li class="nav-item">
                        @if (Route::has('login'))
                            @auth
                                <a class="btn border border-dark rounded-pill" href="{{ route('dashboard') }}">Dashboard</a>
                            @else
                                <a class="btn border border-dark rounded-pill" href="{{ route('login') }}">Log in</a>
                                <a class="btn bg-dark text-white rounded-pill" href="{{ route('register') }}">Register</a>
                            @endauth
                        @endif
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="page-header align-items-start min-vh-70 m-3 border-radius-lg"
        style="background-image: url('{{ asset('assets/bg-hero.jpg') }}')" id="home">
        <div class="container col-xl-10 col-xxl-8 px-4 py-5">
            <div class="row align-items-center g-lg-5 py-5">
                <div class="col-lg-7 text-center text-lg-start">
                    <h1 class="display-4 fw-bold lh-1 mb-3 text-white">Where You Get Trapped in the Beauty of the World
                        and Unforgettable Happiness!</h1>
                    <a href="{{ route('order.index') }}" class="btn btn-dark"><i
                            class="fa-solid fa-shop me-2 bg-white text-dark p-2 rounded-pill"></i>Booking Now</a>
                </div>
                <div class="col-md-10 mx-auto col-lg-5">
                    <form class="p-3 p-md-4 border bg-light rounded-3" action="{{ route('home.filter') }}">
                        <div class="card-header">
                            <p class="text-lg"><i class="fa-solid fa-plane me-2"></i>Find Plane</p>
                        </div>
                        <div class="form mb-3">
                            <label for="departing" class="form-label">Departing From</label>
                            <div class="input-group">
                                <span class="input-group-text border border-primary"><i
                                        class="fa-solid fa-location-dot mx-2"></i></span>
                                <input type="text" class="form-control p-3 border border-primary"
                                    placeholder="Departing From" name="departing">
                            </div>
                        </div>
                        <div class="form mb-3">
                            <label for="arriving" class="form-label">Arriving To</label>
                            <div class="input-group">
                                <span class="input-group-text border border-primary"><i
                                        class="fa-solid fa-location-dot mx-2"></i></span>
                                <input type="text" class="form-control p-3 border border-primary"
                                    placeholder="Arriving To" name="arriving">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form mb-3 col-md-6">
                                <label for="departuredate" class="form-label" name="departuredate"
                                    id="departuredate">Departing Date</label>
                                <div class="input-group">
                                    <input type="date" class="form-control p-3 border border-primary"
                                        name="departuredate">
                                </div>
                            </div>
                            <div class="form mb-3 col-md-6">
                                <label for="departing" class="form-label" name="arrivaldate" id="arrivaldate">Arriving
                                    Date</label>
                                <div class="input-group">
                                    <input type="date" class="form-control p-3 border border-primary"
                                        name="arrivaldate">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="col-md-12 btn btn-lg btn-primary rounded-pill"
                            type="submit">Search Flights</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="row m-5" id="booking">
        <div class="col-md-5">
            <h1 class="text-start">Recommended For You</h1>
        </div>
        <div class="col-md-6">
            <p class="text-end">I hope you find this</p>
            <p class="text-end">recommendations enjoyable!</p>
        </div>
    </div>
    <div class="container">
        <div class="row">
            @forelse ($schedules as $schedule)
                <div class="col-md-6">
                    <div class="card mb-5">
                        <div class="card-header bg-primary p-3">
                            <p class="text-lg text-white"><i class="fa-solid fa-ticket me-2"></i>Plane Ticket</p>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card-body">
                                    <p class="text-sm">Airline Name</p>
                                    <h5 class="mt-0 text-uppercase">{{ $schedule->airline->name }}</h5>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card-body">
                                    <p class="text-sm">Airline Code</p>
                                    <h5 class="mt-0 text-uppercase">{{ $schedule->airline->code }}</h5>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card-body">
                                    <p class="text-sm">Plane Name</p>
                                    <h5 class="mt-0 text-uppercase">{{ $schedule->plane->name }}</h5>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card-body">
                                    <p class="text-sm">Departing From</p>
                                    <h5 class="mt-0">{{ $schedule->departing }}</h5>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card-body">
                                    <p class="text-sm">Arriving To</p>
                                    <h5 class="mt-0">{{ $schedule->arriving }}</h5>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card-body">
                                    <p class="text-sm">Depature Date</p>
                                    <h5 class="mt-0">{{ $schedule->departuredate }}</h5>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card-body">
                                    <p class="text-sm">Arriving Date</p>
                                    <h5 class="mt-0">{{ $schedule->arrivaldate }}</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card-body">
                                <p class="text-sm">Price Tickets</p>
                                <h5 class="mt-0">RP. {{ number_format($schedule->price, 0, ',', '.') }}</h5>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center align-items-center">
                            <a href="{{ route('order.create.front', ['schedule_id' => $schedule->id]) }}"
                                class="col-md-10 btn btn-lg btn-primary rounded-pill">Book Now</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-md-12">
                    <div class="card mb-5">
                        <div class="card-header bg-primary p-3">
                            <p class="text-lg text-white"><i class="fa-solid fa-ticket me-2"></i>Plane Ticket</p>
                        </div>
                        <div class="card-body">
                            <p class="text-center text-lg">No plane ticket found</p>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
        @if (!$schedules->isEmpty())  
            <div class="card-footer d-flex justify-content-end mt-3" style="padding: 1rem 0rem">
                {{ $schedules->links() }}
            </div>
        @endif
    </div>

    <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 m-4 border-top">
        <p class="col-md-4 mb-0 text-muted">&copy; 2025 Paundra</p>

        <a href="{{ route('login') }}"
            class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
            <img src="{{ asset('assets/logo.svg') }}" alt="">
        </a>

        <ul class="nav col-md-4 justify-content-end">
            <li class="nav-item"><a href="#home" class="nav-link px-2 text-muted">Home</a></li>
            <li class="nav-item"><a href="#booking" class="nav-link px-2 text-muted">Booking</a></li>
        </ul>
    </footer>



    <script src="{{ asset('assets/dashboard/assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/assets/js/argon-dashboard.min.js?v=2.1.0') }}"></script>

</body>

</html>
