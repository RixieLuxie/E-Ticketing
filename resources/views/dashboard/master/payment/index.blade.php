@extends ('layouts.dashboard')

@section ('content')
@if (session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
@if ($errors->any())
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <ul class="mb-0">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <h6>Payments Table</h6>
                <button type="button" class="btn btn-primary btn-sm float-end" data-bs-toggle="modal" data-bs-target="#addPayment">
                    Add Payment
                </button>
                <!-- Modal -->
                <div class="modal fade" id="addPayment" tabindex="-1" aria-labelledby="addPaymentLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addPaymentLabel">Add Payments</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('payment.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="logo">Logo Payments</label>
                                        <input type="file" class="form-control" name="logo" id="logo" placeholder="Enter Logo">
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Name Payments</label>
                                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name Payments">
                                    </div>
                                    <div class="form-group">
                                        <label for="nomortujuan">Code Payments</label>
                                        <input type="number" class="form-control" name="nomortujuan" id="nomortujuan" placeholder="Enter Code Payments">
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">No</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Action</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Logo Payment</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Name Payments</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Code Payments</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Created At</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Updated At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($payments as $payment)
                            <tr>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{ $loop->iteration }}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle">
                                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editPayment{{ $payment->id }}">
                                        Edit
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="editPayment{{ $payment->id }}" tabindex="-1" aria-labelledby="editPaymentLabel" aria-hidden="true" >
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editPaymentLabel">Edit Payment</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('payment.update', $payment->id) }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="form-group">
                                                            <label for="logo">Logo Payments</label>
                                                            <input type="file" class="form-control" name="logo" id="logo" placeholder="Enter Logo" value="{{ $payment->logo }}">
                                                            @if ($payment->logo)
                                                                <img src="{{ asset('storage/' . $payment->logo) }}" class="border-radius-lg mt-2 mb-2 w-50 h-50" alt="Logo Payments">
                                                            @else
                                                                <h6 class="mb-0 text-sm ps-2">No Image Preview</h6>
                                                            @endif
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="name">Name Payments</label>
                                                            <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name Payments" value="{{ $payment->name }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="nomortujuan">Code Payments</label>
                                                            <input type="number" class="form-control" name="nomortujuan" id="nomortujuan" placeholder="Enter Code Payments" value="{{ $payment->nomortujuan }}">
                                                        </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <form action="{{ route('payment.destroy', $payment->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                                <td>
                                    <div class="d-flex flex-column justify-content-center">
                                        @if ($payment->logo)
                                        <img src="{{ asset('storage/' . $payment->logo) }}" class="border-radius-lg" alt="Logo" style="max-width: 100px; max-height: 100px;">
                                        @else 
                                        <h6 class="mb-0 text-sm ps-2">No Image</h6>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="mb-0 text-sm ps-2">{{ $payment->name }}</h6>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="mb-0 text-sm ps-2">{{ $payment->nomortujuan }}</h6>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="mb-0 text-sm ps-2">{{ $payment->created_at }}</h6>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="mb-0 text-sm ps-2">{{ $payment->updated_at }}</h6>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer d-flex justify-content-end" style="padding: 1rem 0rem">
                    {{ $payments->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection