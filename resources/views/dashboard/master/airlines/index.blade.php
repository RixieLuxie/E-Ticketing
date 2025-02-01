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
                <h6>Airlines Table</h6>
                <button type="button" class="btn btn-primary btn-sm float-end" data-bs-toggle="modal" data-bs-target="#addAirline">
                    Add Airline
                </button>
                <!-- Modal -->
                <div class="modal fade" id="addAirline" tabindex="-1" aria-labelledby="addAirlineLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addAirlineLabel">Add Airline</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('airline.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="name">Name Airline</label>
                                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter Airline Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="code">Code Airline</label>
                                        <input type="text" class="form-control" name="code" id="code" placeholder="Enter Airline Code">
                                    </div>
                                    <div class="form-group">
                                        <label for="country">Country Airline</label>
                                        <input type="text" class="form-control" name="country" id="country" placeholder="Enter Airline Country">
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
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Airline Name</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Airline Code</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Airline Country</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Airline Status</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Created At</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Updated At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($airlines as $airline)
                            <tr>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{ $loop->iteration }}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle">
                                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editAriline{{ $airline->id }}">
                                        Edit
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="editAriline{{ $airline->id }}" tabindex="-1" aria-labelledby="editArilineLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editArilineLabel">Edit Airline</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('airline.update', $airline->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="form-group">
                                                            <label for="name">Name Airline</label>
                                                            <input type="text" class="form-control" name="name" id="name" placeholder="Enter Airline Name" value="{{ $airline->name }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="code">Code Airline</label>
                                                            <input type="text" class="form-control" name="code" id="code" placeholder="Enter Airline Code" value="{{ $airline->code }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="country">Country Airline</label>
                                                            <input type="text" class="form-control" name="country" id="country" placeholder="Enter Airline Country" value="{{ $airline->country }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="status">Status Airline</label>
                                                            <select class="form-select" name="status" id="status">
                                                                <option value="active" {{ $airline->status == 'active' ? 'selected' : '' }}>Active</option>
                                                                <option value="inactive" {{ $airline->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                                            </select>
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
                                    <form action="{{ route('airline.destroy', $airline->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                                <td>
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="mb-0 text-sm ps-2">{{ $airline->name }}</h6>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="mb-0 text-sm ps-2">{{ $airline->code }}</h6>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="mb-0 text-sm ps-2">{{ $airline->country }}</h6>
                                    </div>
                                </td>
                                <td class="text-sm">
                                    @if ($airline->status == 'active')
                                    <span class="badge badge-sm bg-gradient-success">{{ $airline->status }}</span>
                                    @else ($airline->status == 'inactive')
                                    <span class="badge badge-sm bg-gradient-danger">{{ $airline->status }}</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="mb-0 text-sm ps-2">{{ $airline->created_at }}</h6>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="mb-0 text-sm ps-2">{{ $airline->updated_at }}</h6>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer d-flex justify-content-end" style="padding: 1rem 0rem">
                    {{ $airlines->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection