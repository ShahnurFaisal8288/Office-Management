@extends('backend.partials.app')
@section('content')
@push('css')
<style>
    /* Your existing styles */
    .add-btn {
        width: 60px;
        height: 60px;
        background: #ef5252;
        display: inline-block;
        text-align: center;
        line-height: 60px;
        border-radius: 50%;
        font-size: 30px;
        color: aliceblue;
        cursor: pointer;
    }

    .customer-card {
        display: flex;
        justify-content: space-between;
    }

    .customer-container {
        margin: 0 0 310px 0;
    }

    .action-buttons {
        display: flex;
        white-space: nowrap;
    }

    .action-buttons a {
        margin-right: 5px;
    }

    .table th:nth-child(5),
    .table td:nth-child(5) {
        min-width: 100px;
        max-width: 100px;
        width: 100px;
        word-wrap: break-word;
        white-space: normal;
    }
    .table th:nth-child(4),
    .table td:nth-child(4) {
        min-width: 78px;
        max-width: 78px;
        width: 78px;
        word-wrap: break-word;
        white-space: normal;
    }
    .table th:nth-child(6),
    .table td:nth-child(6) {
        min-width: 85px;
        max-width: 85px;
        width: 85px;
        word-wrap: break-word;
        white-space: normal;
    }
    .table th:nth-child(8),
    .table td:nth-child(8) {
        min-width: 85px;
        max-width: 85px;
        width: 85px;
        word-wrap: break-word;
        white-space: normal;
    }

</style>
<link href="https://cdn.datatables.net/v/bs5/dt-1.13.6/datatables.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
@endpush
<!-- Hoverable Table rows -->
<div class="container customer-container">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="customer-card mb-3" style="margin-top:-10px;">
                        <div class="area-h3 m-3">
                            <h3>Project</h3>
                        </div>
                        <div class="add-btn m-3">
                            <a class="add-btn" data-bs-toggle="modal" data-bs-target="#projectModuleModal"><i class="fas fa-plus"></i></a>
                        </div>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-hover table-borderd" id="example">
                            <thead>
                                <tr>
                                    <th>SI</th>
                                    <th>Project Name</th>
                                    <th>Hours</th>
                                    <th>Project Start Date</th>
                                    <th>Project End Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 1 @endphp
                                @foreach($project as $item)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $item->project_name }}</td>
                                    <td>{{ $item->hour }}</td>
                                    <td>{{ $item->start_date }}</td>
                                    <td>{{ $item->end_date }}</td>
                                    <td>
                                        <div class="action-buttons">
                                            <!-- Edit Button -->
                                            <a class="btn btn-info" data-bs-toggle="modal" data-bs-target="#moduleUpdateModal{{$item->id}}"><i class="fas fa-edit text-white"></i></a>

                                            <!-- View Button -->
                                            <a class="btn btn-info" data-bs-toggle="modal" data-bs-target="#moduleViewModal{{$item->id}}"><i class="fas fa-eye text-white"></i></a>

                                            <!-- Info Button -->
                                            <a href="{{ route('projectDetails', $item->id) }}" class="btn btn-secondary"><i class="fa-solid fa-circle-info"></i></a>

                                            <!-- Delete Button -->
                                            <form action="{{route('projectCreate.destroy',$item->id)}}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                            </form>

                                            <!-- Edit Modal -->
                                            <div class="modal fade" id="moduleUpdateModal{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <form action="{{route('projectCreate.update',$item->id)}}" method="post">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Project</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <!-- Form fields for editing -->
                                                                    <div class="col-md-6 col-xl-6 col-lg-6 col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="project_name"><strong>Project Name</strong></label>
                                                                            <input type="text" id="project_name" name="project_name" value="{{$item->project_name}}" class="form-control my-2">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 col-xl-6 col-lg-6 col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="start_date"><strong>Project Start Date</strong></label>
                                                                            <input type="datetime-local" id="start_date" name="start_date" value="{{ date('Y-m-d\TH:i', strtotime($item->start_date)) }}" class="form-control my-2">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 col-xl-6 col-lg-6 col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="end_date"><strong>Project End Date</strong></label>
                                                                            <input type="datetime-local" id="end_date" name="end_date" value="{{ date('Y-m-d\TH:i', strtotime($item->end_date)) }}" class="form-control my-2">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 col-xl-6 col-lg-6 col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="hour"><strong>Hour</strong></label>
                                                                            <input type="text" id="hour" value="{{$item->hour}}" name="hour" class="form-control my-2" readonly>
                                                                        </div>
                                                                    </div>
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
                                            {{-- end edit modal --}}

                                            <!-- View Modal -->
                                            <div class="modal fade" id="moduleViewModal{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-xl">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            {{-- <h1 class="modal-title fs-5" id="exampleModalLabel">Project Details</h1> --}}
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div>
                                                                    <h5>Project Title : {{ $item->project_name }}</h5>
                                                                    <hr>
                                                                    <div>
                                                                        @php
                                                                        $hours = \App\Models\ProjectDetails::where('project_create_id',$item->id)->sum('hours');
                                                                        @endphp
                                                                        <h5>Total Hour : {{ $item->hour }} hour</h5>
                                                                        <h5>Total TAT : {{ $hours }} hour</h5>
                                                                        @php
                                                                        $projectDetails = \App\Models\ProjectDetails::where('project_create_id',$item->id)->get();

                                                                        @endphp
                                                                        <div class="col-lg-12" style="width:100%">
                                                                            <table class="table table-striped table-bordered">
                                                                                <thead class="table-success">
                                                                                    <tr>
                                                                                        <th>Module</th>
                                                                                        <th>Features</th>
                                                                                        <th>Employees</th>
                                                                                        <th style="min-width: 78px; max-width: 78px; width: 78px;">Status</th>
                                                                                        <th style="min-width: 100px; max-width: 100px; width: 100px;">Details</th>
                                                                                        <th style="min-width: 85px; max-width: 85px; width: 85px;">Estimate <i class="fa-solid fa-clock"></i></th>
                                                                                        <th>TAT</th>
                                                                                        <th style="min-width: 100px; max-width: 100px; width: 100px;">Remarks</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    @foreach($projectDetails as $key => $value)
                                                                                    <tr>
                                                                                        <td>{{ $value->modules->module_name ?? '' }}</td>
                                                                                        <td>{{ implode(',',json_decode($value->features )) }}</td>
                                                                                        @php
                                                                                        $employeeIds = json_decode($value->employee_id);
                                                                                        $employeeNames = \App\Models\Employee::whereIn('id', $employeeIds)->pluck('name')->toArray();
                                                                                        @endphp
                                                                                        <td >{{ implode(', ', $employeeNames) }}</td>
                                                                                        <td style="min-width: 78px; max-width: 78px; width: 78px;">
                                                                                            @if ($value->status  == 'incomplete')
                                                                                            <span class="badge  bg-danger">{{ $value->status }}</span>
                                                                                            @elseif($value->status  == 'ongoing')
                                                                                            <span class="badge  bg-warning text-dark">{{ $value->status }}</span>
                                                                                            @else
                                                                                            <span class="badge  bg-success">{{ $value->status }}</span>
                                                                                            @endif
                                                                                        </td>
                                                                                        <td style="min-width: 100px; max-width: 50px; width: 100px;">{{ $value->details }}</td>
                                                                                        <td style="min-width: 85px; max-width: 85px; width: 85px;">{{ $value->hours }}</td>
                                                                                        <td >12</td>
                                                                                        <td style="min-width: 100px; max-width: 100px; width: 100px;">This module is complete</td>
                                                                                    </tr>
                                                                                    @endforeach

                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                        <hr>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- end view modal --}}
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
<!--/ Hoverable Table rows -->

<!-- project Modal -->
<div class="modal fade" id="projectModuleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        @include('error')
        <form action="{{route('projectCreate.store')}}" method="post">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Project Create</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 col-xl-12 col-lg-12 col-sm-12">
                            <div class="form-group">
                                <label for="project_name"><strong>Project Name</strong></label>
                                <input type="text" id="project_name" name="project_name" class="form-control my-2">
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-6 col-lg-6 col-sm-6">
                            <div class="form-group">
                                <label for="start_date"><strong>Project Start Date</strong></label>
                                <input type="datetime-local" id="start_date1" name="start_date" class="form-control my-2">
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-6 col-lg-6 col-sm-6">
                            <div class="form-group">
                                <label for="end_date"><strong>Project End Date</strong></label>
                                <input type="datetime-local" id="end_date1" name="end_date" class="form-control my-2">
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-6 col-lg-6 col-sm-6">
                            <div class="form-group">
                                <label for="hour"><strong>Hour</strong></label>
                                <input type="text" id="hour1" name="hour" class="form-control my-2" readonly>
                            </div>
                        </div>
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
{{-- end modal --}}

@endsection
@push('js')
<script src="https://cdn.datatables.net/v/bs5/dt-1.13.6/datatables.min.js"></script>
<script>
    new DataTable('#example', {
        select: true
    });

</script>
<script>
    $(document).ready(function() {
        // Event listener for the first modal
        $('#start_date, #end_date').on('change', function() {
            calculateHourDifference('#start_date', '#end_date', '#hour');
        });

        // Event listener for the second modal
        $('#start_date1, #end_date1').on('change', function() {
            calculateHourDifference('#start_date1', '#end_date1', '#hour1');
        });

        // Function to calculate and update hours
        function calculateHourDifference(startDateSelector, endDateSelector, hourSelector) {
            var startDateTime = $(startDateSelector).val();
            var endDateTime = $(endDateSelector).val();

            console.log("Start Date Time: ", startDateTime);
            console.log("End Date Time: ", endDateTime);

            if (startDateTime && endDateTime) {
                startDateTime = new Date(startDateTime);
                endDateTime = new Date(endDateTime);

                console.log("Parsed Start Date Time: ", startDateTime);
                console.log("Parsed End Date Time: ", endDateTime);

                var timeDiff = endDateTime.getTime() - startDateTime.getTime(); // difference in milliseconds
                var hours = timeDiff / (1000 * 60 * 60); // convert milliseconds to hours

                console.log("Time Difference in Hours: ", hours);

                $(hourSelector).val(hours.toFixed(2)); // show result rounded to 2 decimal places
            } else {
                $(hourSelector).val('');
            }
        }
    });
    $(document).ready(function() {
        $('#start_date1, #end_date1').on('change', function() {
            calculateHourDifference();
        });

        function calculateHourDifference() {
            var startDateTime = $('#start_date1').val();
            var endDateTime = $('#end_date1').val();

            if (startDateTime && endDateTime) {
                startDateTime = new Date(startDateTime);
                endDateTime = new Date(endDateTime);

                var timeDiff = endDateTime.getTime() - startDateTime.getTime(); // difference in milliseconds
                var hours = timeDiff / (1000 * 60 * 60); // convert milliseconds to hours

                $('#hour1').val(hours.toFixed(2)); // show result rounded to 2 decimal places
            } else {
                $('#hour1').val('');
            }
        }
    });

</script>
@endpush
