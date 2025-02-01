@extends ('layouts.dashboard')

@section('content')
    <x-notif />
    <div class="row">
        <div class="col-md-4">
            <div class="card my-3">
                <div class="card-body">
                    <h6 class="mb-0">Booking Passengger</h6>
                </div>
            </div>
        </div>
    </div>
    @if (auth()->user()->role == 'user')
    <div class="col-md-5 mb-3">
        <div class="card-body bg-white rounded-3">
            <form action="{{ route('booking.filter') }}" method="GET">
                <div class="row mb-3 p-3">
                    <div class="col-md-6">
                        <label for="status" class="form-label">Filter Schedule Status</label>
                        <select class="form-select" name="status" id="status">
                            <option value="">-- All --</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="landing" {{ request('status') == 'landing' ? 'selected' : '' }}>Landing</option>
                            <option value="departing" {{ request('status') == 'departing' ? 'selected' : '' }}>Departing
                            </option>
                            <option value="arriving" {{ request('status') == 'arriving' ? 'selected' : '' }}>Arriving
                            </option>
                            <option value="closed" {{ request('status') == 'closed' ? 'selected' : '' }}>Closed</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="statuspay" class="form-label">Filter Payment Status</label>
                        <select class="form-select" name="statuspay" id="statuspay">
                            <option value="">-- All --</option>
                            <option value="Pending" {{ request('statuspay') == 'Pending' ? 'selected' : '' }}>Pending
                            </option>
                            <option value="Done" {{ request('statuspay') == 'Done' ? 'selected' : '' }}>Done</option>
                            <option value="Rejected" {{ request('statuspay') == 'Rejected' ? 'selected' : '' }}>Rejected
                            </option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4 mx-3">
                    <button type="submit" class="btn btn-primary">Search</button>
                    <a href="{{ route('booking.index') }}" class="btn btn-secondary ms-2">Reset Filter</a>
                </div>
            </form>
        </div>
    </div>
    @endif




    <div class="row">
        @foreach ($bookings as $booking)
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body px-3 py-2">
                        <div class="row">
                            <div class="col-4">
                                <p class="text-sm">Airline Name</p>
                                <h5 class="mb-0">{{ $booking->schedule->airline->name }}</h5>
                            </div>
                            <div class="col-4">
                                <p class="text-sm">Airline Code</p>
                                <h5 class="mb-0">{{ $booking->schedule->airline->code }}</h5>
                            </div>
                            <div class="col-4">
                                <p class="text-sm">No Tickets</p>
                                <h5 class="mb-0">{{ $booking->noticket }}</h5>
                            </div>
                        </div>
                        <hr class="my-2 bg-dark">
                        <div class="row">
                            <div class="col-6">
                                <p class="text-sm">Status Schedule</p>
                                <td class="text-sm">
                                    @if ($booking->schedule->Status == 'pending')
                                        <span class="badge bg-warning">Pending</span>
                                    @elseif ($booking->schedule->Status == 'landing')
                                        <span class="badge bg-info">Landing</span>
                                    @elseif ($booking->schedule->Status == 'departing')
                                        <span class="badge bg-primary">Departing</span>
                                    @elseif ($booking->schedule->Status == 'arriving')
                                        <span class="badge bg-secondary">Arriving</span>
                                    @elseif ($booking->schedule->Status == 'closed')
                                        <span class="badge bg-danger">Closed</span>
                                    @endif
                                </td>
                            </div>
                            <div class="col-6">
                                <p class="text-sm">Code Seat</p>
                                <span class="badge bg-info">
                                    @php
                                        $seatId = $booking->seatid;
                                        $seatCode = Seat::where('id', $seatId)->value('codeseat');
                                    @endphp
                                    {{ $seatCode }}
                                </span>
                            </div>

                        </div>
                        <hr class="my-2 ">
                        <div class="row">
                            <div class="col-6">
                                <p class="text-sm">Departure Date</p>
                                <h5 class="mb-0">{{ $booking->schedule->departuredate }}</h5>
                            </div>
                            <div class="col-6">
                                <p class="text-sm">Arrival Date</p>
                                <h5 class="mb-0">{{ $booking->schedule->arrivaldate }}</h5>
                            </div>
                        </div>
                        <hr class="my-2 ">
                        <div class="row">
                            <div class="col-6">
                                <p class="text-sm">Departing From</p>
                                <h5 class="mb-0">{{ $booking->schedule->departing }}</h5>
                            </div>
                            <div class="col-6">
                                <p class="text-sm">Arriving To</p>
                                <h5 class="mb-0">{{ $booking->schedule->arriving }}</h5>
                            </div>
                        </div>
                        <hr class="my-2 bg-dark">
                        <div class="row">
                            <div class="col-6">
                                <p class="text-sm">Status Pay</p>
                                <td class="text-sm">
                                    @if ($booking->statuspay == 'Pending')
                                        <span class="badge bg-warning col-6">Pending</span>
                                    @elseif ($booking->statuspay == 'Done')
                                        <span class="badge bg-success col-6">Done</span>
                                    @else
                                        <span class="badge bg-danger col-6">Reject</span>
                                    @endif
                                </td>
                            </div>
                            <div class="col-6">
                                <p class="text-sm">Payment With</p>
                                <td class="text-sm">
                                    @if ($booking->payment)
                                        <h5 class="mb-0">{{ $booking->payment->name }}</h5>
                                    @else
                                        <h5 class="mb-0">Payment not available</h5>
                                    @endif
                                </td>
                            </div>
                        </div>
                        @if (Auth::user()->role == 'admin')
                            <hr class="my-2 bg-dark">
                            <div class="col-12">
                                <a href="{{ route('booking.preview', ['booking_id' => $booking->id]) }}"
                                    class="btn btn-info btn-sm col-12">Preview Data</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-end" style="padding: 1rem 0rem">
        {{ $bookings->links() }}
    </div>
    </div>
@endsection
