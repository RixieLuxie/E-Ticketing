@extends('layouts.dashboard')

@section('content')
    <x-notif />
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('booking.index') }}" class="btn btn-primary">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                    <h6 class="mb-0">Create Order</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label for="arilinename">Airline Name</label>
                            <input type="text" name="arilinename" class="form-control"
                                value="{{ $bookings->schedule->airline->name }}" disabled>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="airlinecode">Airline Code</label>
                            <input type="text" name="airlinecode" class="form-control"
                                value="{{ $bookings->schedule->airline->code }}" disabled>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="departuredate">Departure Date</label>
                            <input type="text" name="departuredate" class="form-control"
                                value="{{ $bookings->schedule->departuredate }}" disabled>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="arrivaldate">Arriving Date</label>
                            <input type="text" name="arrivaldate" class="form-control"
                                value="{{ $bookings->schedule->arrivaldate }}" disabled>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="departing">Departing From</label>
                            <input type="text" name="departing" class="form-control"
                                value="{{ $bookings->schedule->departing }}" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="arriving">Arriving To</label>
                            <input type="text" name="arriving" class="form-control"
                                value="{{ $bookings->schedule->arriving }}" disabled>
                        </div>
                    </div>
                    <div class="row">
                        <div class="d-flex justify-content-center align-items-center">
                            <div class="form-group col-md-2 text-center">
                                <label for="price">Total Price</label>
                                <input type="text" name="price" class="form-control"
                                    value="Rp. {{ isset($bookings->schedule->price) ? number_format($bookings->schedule->price, 0, ',', '.') : '' }}"
                                    disabled>
                            </div>
                            <div class="form-group col-md-2 text-center  mx-4">
                                <label for="totalseats">Total Seats</label>
                                <input type="text" name="totalseats" class="form-control"
                                    value="{{ $bookings->schedule->plane->seats->count() }}" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="userid">Name Passenger</label>
                            <input type="text" name="userid" class="form-control" value="{{ $bookings->user->name }}"
                                disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="seatid">Seats</label>
                            <input class="form-control" id="seatid" name="seatid"
                                value="{{ \App\Models\Seat::find($bookings->seatid)->codeseat }}" disabled></input>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="paymentid">Payment Method</label>
                            <input class="form-control" id="paymentid" name="paymentid"
                                value="{{ $bookings->payment->name }}" disabled></input>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            @if ($bookings->bukti_pembayaran)
                                <!-- Tombol untuk membuka modal -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#previewModal">
                                    View Bukti Pembayaran
                                </button>
                            @endif
                        </div>
                    </div>

                    <div class="modal fade" id="previewModal" tabindex="-1" aria-labelledby="previewModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="previewModalLabel">Bukti Pembayaran</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-center">
                                    @php
                                        $fileExtension = pathinfo($bookings->bukti_pembayaran, PATHINFO_EXTENSION);
                                    @endphp

                                    @if (in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif']))
                                        <img src="{{ asset('storage/' . $bookings->bukti_pembayaran) }}"
                                            alt="Bukti Pembayaran" class="img-fluid">
                                    @elseif ($fileExtension === 'pdf')
                                        <iframe src="{{ asset('storage/' . $bookings->bukti_pembayaran) }}"
                                            width="100%" height="500px"></iframe>
                                    @else
                                        <p>Preview tidak tersedia untuk file ini. <a
                                                href="{{ asset('storage/' . $bookings->bukti_pembayaran) }}"
                                                target="_blank" class="btn btn-primary">Download File</a></p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <form action="{{ route('booking.approve', ['booking' => $bookings->id]) }}" method="POST"
                                class="d-inline">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-success">Approve</button>
                            </form>
                            <form action="{{ route('booking.decline', ['booking' => $bookings->id]) }}" method="POST"
                                class="d-inline">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-danger">Reject</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection('content')
