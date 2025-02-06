@extends ('layouts.dashboard')

@section('content')
    <x-notif />
    <div class="col-md-12">
        <div class="card my-3">
            <div class="card-header pb-0 pt-3">
                <button class="btn btn-info btn-sm" id="toggleFilterBtn" style="float: right;">Hide Filter</button>
                <h5 class="mb-0">Filter Schedule</h5>
            </div>
            <div class="card-body" id="filterForm">
                <form action="{{ route('order.filter') }}" method="GET">
                    @csrf
                    <div class="form-group col-md-12">
                        <label for="search">Search</label>
                        <input type="text" name="search" id="search" class="form-control"
                            placeholder="Search by airline name or code" value="{{ request()->get('search') }}">
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="departing">Departing From</label>
                                <input type="text" name="departing" id="departing" class="form-control"
                                    placeholder="Search by Departing From" value="{{ request()->get('departing') }}">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="arriving">Arriving To</label>
                            <input type="text" name="arriving" id="arriving" class="form-control"
                                placeholder="Search by Arriving To" value="{{ request()->get('arriving') }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="departuredate">Departing Date</label>
                                <input type="date" name="departuredate" id="departuredate" class="form-control"
                                    value="{{ request()->get('departuredate') }}">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="arrivaldate">Arriving Date</label>
                            <input type="date" name="arrivaldate" id="arrivaldate" class="form-control"
                                value="{{ request()->get('arrivaldate') }}">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary mt-2">Search</button>
                    <a href="{{ route('order.index') }}" class="btn btn-secondary mt-2">Reset Filter</a>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('toggleFilterBtn').addEventListener('click', function() {
            var filterForm = document.getElementById('filterForm');
            if (filterForm.style.display === "none") {
                filterForm.style.display = "block";
                this.textContent = 'Hide Filter';
            } else {
                filterForm.style.display = "none";
                this.textContent = 'Show Filter';
            }
        });
    </script>
    <div class="row">
        @foreach ($schedules as $schedule)
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body px-3 py-2">
                        <div class="row">
                            <div class="col-4">
                                <p class="text-sm">Airline Name</p>
                                <h5 class="mb-0">{{ $schedule->airline->name }}</h5>
                            </div>
                            <div class="col-4">
                                <p class="text-sm">Airline Code</p>
                                <h5 class="mb-0">{{ $schedule->airline->code }}</h5>
                            </div>
                            <div class="col-4">
                                <p class="text-sm">Plane Name</p>
                                <h5 class="mb-0">{{ $schedule->plane->name }}</h5>
                            </div>
                        </div>
                        <hr class="my-2 bg-dark">
                        <div class="row">
                            <div class="col-6">
                                <p class="text-sm">Status</p>
                                <td class="text-sm">
                                    @if ($schedule->Status == 'pending')
                                        <span class="badge bg-warning">Pending</span>
                                    @elseif ($schedule->Status == 'landing')
                                        <span class="badge bg-info">Landing</span>
                                    @elseif ($schedule->Status == 'departing')
                                        <span class="badge bg-primary">Departing</span>
                                    @elseif ($schedule->Status == 'arriving')
                                        <span class="badge bg-secondary">Arriving</span>
                                    @elseif ($schedule->Status == 'closed')
                                        <span class="badge bg-danger">Closed</span>
                                    @endif
                                </td>
                            </div>
                            <div class="col-6">
                                <p class="text-sm">Available Seats</p>
                                <span class="badge bg-info">{{ $schedule->availableSeats }}</span>
                            </div>
                        </div>
                        <hr class="my-2 ">
                        <div class="row">
                            <div class="col-6">
                                <p class="text-sm">Departure Date</p>
                                <h5 class="mb-0">{{ $schedule->departuredate }}</h5>
                            </div>
                            <div class="col-6">
                                <p class="text-sm">Arrival Date</p>
                                <h5 class="mb-0">{{ $schedule->arrivaldate }}</h5>
                            </div>
                        </div>
                        <hr class="my-2 ">
                        <div class="row">
                            <div class="col-6">
                                <p class="text-sm">Departing From</p>
                                <h5 class="mb-0">{{ $schedule->departing }}</h5>
                            </div>
                            <div class="col-6">
                                <p class="text-sm">Arriving To</p>
                                <h5 class="mb-0">{{ $schedule->arriving }}</h5>
                            </div>
                        </div>
                        <hr class="my-2 bg-dark">
                        <div class="row">
                            <div class="col-6">
                                <p class="text-sm">Price Tickets</p>
                                <h5 class="mb-0">RP. {{ number_format($schedule->price, 0, ',', '.') }}</h5>
                            </div>
                        </div>
                        <hr class="my-2 bg-dark">
                        @if ($schedule->availableSeats == 0)
                            <div class="row">
                                <h6 class="text-center text-light bg-danger p-2 rounded fw-bold">Sold Out</h6>
                            </div>
                        @else
                        <div class="row">
                            <a href="{{ route('order.create.front', ['schedule_id' => $schedule->id]) }}"
                                class="btn btn-success">Book Now</a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-end" style="padding: 1rem 0rem">
        {{ $schedules->links() }}
    </div>
    </div>
@endsection
