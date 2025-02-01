@extends ('layouts.dashboard')

@section ('content')
<x-notif />
<div class="row">
  <div class="col-12">
    <div class="card mb-4">
      <div class="card-header pb-0">
        <h6>Schedule Table</h6>
        <button type="button" class="btn btn-primary btn-sm float-end" data-bs-toggle="modal" data-bs-target="#addSchedule">
          Add Schedule
        </button>
        <!-- Modal -->
        <div class="modal fade" id="addSchedule" tabindex="-1" aria-labelledby="addSchedule" Label aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="addSchedule" Label>Add Schedule</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form action="{{ route('schedule.store') }}" method="POST">
                  @csrf
                  <div class="form-group">
                    <label for="airlineid">Name Airline</label>
                    <select class="form-select" name="airlineid" id="airlineid">
                      <option value="" disabled>Select Airline</option>
                      @foreach ($airlines as $airline)
                      <option value="{{ $airline->id }}">{{ $airline->name }}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="planesid">Name Plane</label>
                    <select class="form-select" name="planesid" id="planesid">
                      <option value="" disabled>Select Plane</option>
                      @foreach ($planes as $plane)
                      <option value="{{ $plane->id }}">{{ $plane->name }}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="departuredate">Departure Date</label>
                    <input type="datetime-local" class="form-control" name="departuredate" id="departuredate" placeholder="Enter Departure Date" value="">
                  </div>

                  <div class="form-group">
                    <label for="arrivaldate">Arrival Date</label>
                    <input type="datetime-local" class="form-control" name="arrivaldate" id="arrivaldate" placeholder="Enter Arrival Date" value="">
                  </div>

                  <div class="form-group">
                    <label for="departing">Departing</label>
                    <select class="form-select" name="departing" id="departing">
                      <option value="" disabled>Select Departing</option>
                      @foreach ($airports as $airport)
                      <option value="{{ $airport->name }}">{{ $airport->name }}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="arriving">Arriving</label>
                    <select class="form-select" name="arriving" id="arriving">
                      <option value="" disabled>Select Arriving</option>
                      @foreach ($airports as $airport)
                      <option value="{{ $airport->name }}">{{ $airport->name }}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="Status">Status Schedule</label>
                    <select class="form-select" name="Status" id="Status">
                      <option value="pending">Pending</option>
                      <option value="landing">Landing</option>
                      <option value="departing">Departing</option>
                      <option value="arriving">Arriving</option>
                      <option value="closed">Closed</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" class="form-control" name="price" id="price" placeholder="Enter Price" value="">
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
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-3">No</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-3">Action</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-3">Airline Name</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-3">Airline Code</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-3">Plane Name</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-3">Total Seats</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-3">Departure Date</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-3">Arrival Date</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-3">Departing</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-3">Arriving</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-3">Status</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-3">Price</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-3">Created At</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-3">Updated At</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($schedules as $schedule)
              <tr>
                <td>
                  <div class="d-flex px-2 py-1">
                    <div class="d-flex flex-column justify-content-center">
                      <h6 class="mb-0 text-sm">{{ $loop->iteration }}</h6>
                    </div>
                  </div>
                </td>
                <td class="align-middle">
                  <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editSchedule{{ $schedule->id }}">
                    Edit
                  </button>
                  <!-- Modal -->
                  <div class="modal fade" id="editSchedule{{ $schedule->id }}" tabindex="-1" aria-labelledby="editScheduleLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="editScheduleLabel">Edit Schedule</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <form action="{{ route('schedule.update', $schedule->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                              <label for="airlineid">Name Airline</label>
                              <select class="form-select" name="airlineid" id="airlineid" onchange="filterPlanes()">
                                <option value="" disabled>Select Airline</option>
                                @foreach ($airlines as $airline)
                                <option value="{{ $airline->id }}" data-airline-id="{{ $airline->id }}" {{ $schedule->airlineid == $airline->id ? 'selected' : '' }}>{{ $airline->name }}</option>
                                @endforeach
                              </select>
                            </div>

                            <div class="form-group">
                              <label for="planesid">Name Plane</label>
                              <select class="form-select" name="planesid" id="planesid">
                                <option value="" disabled>Select Plane</option>
                                @foreach ($planes as $plane)
                                <option value="{{ $plane->id }}" data-airline-id="{{ $plane->airlineid }}" {{ $schedule->planesid == $plane->id ? 'selected' : '' }}>{{ $plane->name }}</option>
                                @endforeach
                              </select>
                            </div>

                            <div class="form-group">
                              <label for="departuredate">Departure Date</label>
                              <input type="datetime-local" class="form-control" name="departuredate" id="departuredate" placeholder="Enter Departure Date" value="{{ $schedule->departuredate}}">
                            </div>

                            <div class="form-group">
                              <label for="arrivaldate">Arrival Date</label>
                              <input type="datetime-local" class="form-control" name="arrivaldate" id="arrivaldate" placeholder="Enter Arrival Date" value="{{ $schedule->arrivaldate }}">
                            </div>

                            <div class="form-group">
                              <label for="departing">Departing</label>
                              <select class="form-select" name="departing" id="departing">
                                <option value="" disabled>Select Departing</option>
                                @foreach ($airports as $airport)
                                <option value="{{ $airport->name }}" {{ $airport->name == $schedule->departing ? 'selected' : '' }}>{{ $airport->name }}</option>
                                @endforeach
                              </select>
                            </div>

                            <div class="form-group">
                              <label for="arriving">Arriving</label>
                              <select class="form-select" name="arriving" id="arriving">
                                <option value="" disabled>Select Arriving</option>
                                @foreach ($airports as $airport)
                                <option value="{{ $airport->name }}" {{ $airport->name == $schedule->arriving ? 'selected' : '' }}>{{ $airport->name }}</option>
                                @endforeach
                              </select>
                            </div>

                            <div class="form-group">
                              <label for="Status">Status Schedule</label>
                              <select class="form-select" name="Status" id="Status">
                                <option value="pending" {{ $schedule->Status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="landing" {{ $schedule->Status == 'landing' ? 'selected' : '' }}>Landing</option>
                                <option value="departing" {{ $schedule->Status == 'departing' ? 'selected' : '' }}>Departing</option>
                                <option value="arriving" {{ $schedule->Status == 'arriving' ? 'selected' : '' }}>Arriving</option>
                                <option value="closed" {{ $schedule->Status == 'closed' ? 'selected' : '' }}>Closed</option>
                              </select>
                            </div>

                            <div class="form-group">
                              <label for="price">Price</label>
                              <input type="number" class="form-control" name="price" id="price" placeholder="Enter Price" value="{{ $schedule->price }}">
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
                  <form action="{{ route('schedule.destroy', $schedule->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                  </form>
                </td>
                <td>
                  <div class="d-flex flex-column">
                    <h6 class="mb-0 text-sm ps-2">{{ $schedule->airline->name }}</h6>
                  </div>
                </td>
                <td>
                  <div class="d-flex flex-column ">
                    <h6 class="mb-0 text-sm ps-2">{{ $schedule->airline->code }}</h6>
                  </div>
                </td>
                <td>
                  <div class="d-flex flex-column ">
                    <h6 class="mb-0 text-sm ps-2">{{ $schedule->plane->name }}</h6>
                  </div>
                </td>
                <td>
                  <div class="d-flex flex-column">
                    <h6 class="mb-0 text-sm ps-2">{{ $schedule->plane->seats->count() }}</h6>
                  </div>
                </td>
                <td>
                  <div class="d-flex flex-column ">
                    <h6 class="mb-0 text-sm ps-2">{{ $schedule->departuredate }}</h6>
                  </div>
                </td>
                <td>
                  <div class="d-flex flex-column ">
                    <h6 class="mb-0 text-sm ps-2">{{ $schedule->arrivaldate }}</h6>
                  </div>
                </td>
                <td>
                  <div class="d-flex flex-column ">
                    <h6 class="mb-0 text-sm ps-2">{{ $schedule->departing }}</h6>
                  </div>
                </td>
                <td>
                  <div class="d-flex flex-column ">
                    <h6 class="mb-0 text-sm ps-2">{{ $schedule->arriving }}</h6>
                  </div>
                </td>
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
                <td>
                  <div class="d-flex flex-column ">
                    <h6 class="mb-0 text-sm ps-2">{{ $schedule->price }}</h6>
                  </div>
                </td>
                <td>
                  <div class="d-flex flex-column ">
                    <h6 class="mb-0 text-sm ps-2">{{ $schedule->created_at }}</h6>
                  </div>
                </td>
                <td>
                  <div class="d-flex flex-column ">
                    <h6 class="mb-0 text-sm ps-2">{{ $schedule->updated_at }}</h6>
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          <div class="card-footer d-flex justify-content-end" style="padding: 1rem 0rem">
            {{ $schedules->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection