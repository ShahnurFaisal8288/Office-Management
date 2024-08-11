@extends('backend.partials.app')
@section('title')
Attendance
@endsection
@section('content')
@push('css')
<link href="https://cdn.datatables.net/v/bs5/dt-1.13.6/datatables.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
@endpush
<div class="container">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xl-12 col-lg-12">
            <div class="card m-3">
                <div class="card-head">
                    <div class="main-dev m-3" style="display:flex;justify-content:space-between;">
                        <h1 style="margin:0 !important">Attendance</h1>
                        <a data-bs-toggle="modal" data-bs-target="#createModal" class="btn btn-primary" style="color:#fff !important">Create Attendance</a>
                    </div>

                </div>
            </div>
            <!-- <div class="attendance-btn text-center">
                @if($attendanceIN)
                <a href="{{ route('end.attendance', $employeeId) }}" class="btn btn-danger" style="display: inline-block;padding:19px;margin:15px;">End Attendance</a>
                @elseif($attendanceOut)
                <a href="{{ route('get.attendance') }}" class="btn btn-info" style="display: inline-block;padding:19px;margin:15px;">Get Attendance</a>
                @else
                <a href="{{ route('get.attendance') }}" class="btn btn-primary" style="display: inline-block;padding:19px;margin:15px;">Start Attendance</a>
                @endif
            </div> -->
            <div class="card m-3">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-borderd" id="example">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Name</th>
                                    <th>Strat Time</th>
                                    <th>Late</th>
                                    <th>End Time</th>
                                    <th>Over Time</th>
                                    <th>Total Hour</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $i =1;
                                @endphp
                                @foreach($attendanceList as $value)
                                <tr>
                                    <td>{{\Carbon\Carbon::parse($value->created_at)->format('d-m-y')}}</td>
                                    <td>{{$value->employee->name ?? ''}}</td>
                                    <td>{{ $value->checkin ? \Carbon\Carbon::parse($value->checkin)->format('h:i A') : '' }}</td>
                                    <td>
                                        @if($value->checkin)
                                        @php
                                        $checkinTime = \Carbon\Carbon::parse($value->checkin);
                                        $standardTime = \Carbon\Carbon::parse($checkinTime->format('Y-m-d') . ' 10:00:00');
                                        $lateMinutes = $standardTime->diffInMinutes($checkinTime, false);
                                        @endphp
                                        @if($lateMinutes > 0)
                                        <span class="text-danger">{{ $lateMinutes }} minutes</span>
                                        @else
                                        On time
                                        @endif
                                        @else
                                        No check-in
                                        @endif
                                    </td>
                                    <td>{{ $value->checkout ? \Carbon\Carbon::parse($value->checkout)->format('h:i A') : '' }}</td>
                                    <td>
                                        @if($value->checkout)
                                        @php
                                        $checkoutTime = \Carbon\Carbon::parse($value->checkout);
                                        $standardTime = \Carbon\Carbon::parse($checkoutTime->format('Y-m-d') . ' 18:00:00');
                                        $overtime = $standardTime->diffInMinutes($checkoutTime, false);
                                        @endphp
                                        @if($overtime > 0)
                                        <span class="text-success">{{ $overtime }} minutes</span>
                                        @else
                                        None
                                        @endif
                                        @else
                                        No check-in
                                        @endif
                                    </td>
                                    <td>
                                        @if($value->checkin && $value->checkout)
                                        @php
                                        $checkinTime = \Carbon\Carbon::parse($value->checkin);
                                        $checkoutTime = \Carbon\Carbon::parse($value->checkout);
                                        $workHours = $checkinTime->diffInHours($checkoutTime);
                                        $workMinutes = $checkinTime->diffInMinutes($checkoutTime) % 60;
                                        @endphp
                                        {{ $workHours }}h {{ $workMinutes }}m
                                        @else
                                        Incomplete
                                        @endif
                                    </td>
                                    <td>
                                        <a data-bs-toggle="modal" data-bs-target="#exampleModal{{$value->id}}" class="btn btn-info"><i class="fa fa-edit"></i></a>

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal{{$value->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <form action="{{route('update.attendance',$value->id)}}" method="post">
                                                    @csrf
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Attendance Edit</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="employee_id">Employee</label>
                                                                <select name="employee_id" id="employee_id" class="form-control m-2">
                                                                    <option value="">Select Employee</option>
                                                                    @foreach($emloyeeList as $list)
                                                                    <option value="{{$list->id}}" {{ $value->employee_id == $list->id ? "selected" : ''}}>{{ $list->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="checkin">Check In</label>
                                                                <input type="datetime-local" name="checkin" value="{{$value->checkin}}" id="checkin" class="form-control">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="checkout">Check Out</label>
                                                                <input type="datetime-local" name="checkout" value="{{$value->checkout}}" id="checkout" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{route('create.attendance')}}" method="post">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Attendance Create</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="employee_id">Employee</label>
                        <select name="employee_id" id="employee_id" class="form-control m-2">
                            <option value="">Select Employee</option>
                            @foreach($emloyeeList as $list)
                            <option value="{{$list->id}}">{{ $list->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="checkin">Check In</label>
                        <input type="datetime-local" name="checkin"  id="checkin" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="checkout">Check Out</label>
                        <input type="datetime-local" name="checkout" id="checkout" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
@push('js')
<script src="https://cdn.datatables.net/v/bs5/dt-1.13.6/datatables.min.js"></script>
<script>
    new DataTable('#example', {
        select: true
    });
</script>
@endpush