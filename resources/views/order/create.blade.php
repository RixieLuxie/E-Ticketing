@extends('layouts.dashboard')

@section('content')
    <x-notif />
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('order.index') }}" class="btn btn-primary">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                    <h6 class="mb-0">Create Order</h6>
                </div>
                @if ($seats->isEmpty())
                    <div class="card-body">
                        <div class="alert alert-danger" role="alert">
                            <h4 class="alert-heading">Warning!</h4>
                            <p>
                                There are no available seats for this schedule.
                            </p>
                        </div>
                    </div>
                @else
                <div class="card-body">
                    <form action="{{ route('order.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <input type="text" name="scheduleid" class="form-control" value="{{ $schedule->id }}" hidden>
                            <div class="form-group col-md-3">
                                <label for="arilinename">Airline Name</label>
                                <input type="text" name="arilinename" class="form-control"
                                    value="{{ $schedule->airline->name }}" disabled>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="airlinecode">Airline Code</label>
                                <input type="text" name="airlinecode" class="form-control"
                                    value="{{ $schedule->airline->code }}" disabled>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="departuredate">Departure Date</label>
                                <input type="text" name="departuredate" class="form-control"
                                    value="{{ $schedule->departuredate }}" disabled>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="arrivaldate">Arriving Date</label>
                                <input type="text" name="arrivaldate" class="form-control"
                                    value="{{ $schedule->arrivaldate }}" disabled>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="departing">Departing From</label>
                                <input type="text" name="departing" class="form-control"
                                    value="{{ $schedule->departing }}" disabled>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="arriving">Arriving To</label>
                                <input type="text" name="arriving" class="form-control" value="{{ $schedule->arriving }}"
                                    disabled>
                            </div>
                        </div>
                        <div class="row">
                            <div class="d-flex justify-content-center align-items-center">
                                <div class="form-group col-md-6 text-center">
                                    <label for="price">Total Price</label>
                                    <input type="text" name="price" class="form-control text-center"
                                        value="Rp. {{ isset($schedule->price) ? number_format($schedule->price, 0, ',', '.') : '' }}"
                                        disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="userid">Name Passenger</label>
                                <input type="text" name="userid" class="form-control" value="{{ Auth::user()->name }}"
                                    disabled>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="seatid">Seats</label>
                                <select name="seatid" class="form-select" required>
                                    <option value="" disabled selected>Select a Seat</option>
                                    @foreach ($seats as $seat)
                                        @if (!$seat->is_booked)
                                            <option value="{{ $seat->id }}">{{ $seat->codeseat }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="paymentid">Select Payment</label>
                                <select class="form-select" id="paymentid" name="paymentid">
                                    <option value="" disabled selected>Select a Payment</option>
                                    @foreach ($payments as $payment)
                                        <option value="{{ $payment->id }}" data-nomortujuan="{{ $payment->nomortujuan }}"
                                            data-image="{{ asset('storage/' . $payment->logo) }}">
                                            {{ $payment->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="d-flex justify-content-center align-items-center">
                                <div class="form-group col-md-6 text-center">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">Payment Details</h5>
                                            <img src="" alt="" id="payment-logo" class="">
                                            <p class="card-text" id="detail">No details available</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="bukti_pembayaran">Proof Of Transaction</label>
                                <input type="file" name="bukti_pembayaran" class="form-control"
                                    id="bukti_pembayaran">
                            </div>
                        </div>

                        <script>
                            document.getElementById('paymentid').addEventListener('change', function() {
                                const selectedOption = this.options[this.selectedIndex];

                                const nomortujuan = selectedOption.getAttribute('data-nomortujuan');
                                const image = selectedOption.getAttribute('data-image');

                                const paymentLogoElement = document.getElementById('payment-logo');
                                paymentLogoElement.src = image;
                                paymentLogoElement.classList = 'mb-2 w-50 h-50 border-radius-lg mx-auto';

                                const detailElement = document.getElementById('detail');
                                detailElement.textContent = nomortujuan ?
                                    `Send to: ${nomortujuan}` :
                                    'No details available';
                            });
                        </script>


                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection('content')
