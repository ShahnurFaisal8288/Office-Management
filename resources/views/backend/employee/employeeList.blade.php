@extends('backend.partials.app')
@section('content')
@push('css')
<style>
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
    white-space: nowrap; /* Prevent wrapping to next line */
}

.action-buttons a,
.action-buttons button {
    margin-right: 5px; /* Adjust spacing between buttons */
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
                            <h2>Employee List</h2>
                        </div>
                        <div class="add-btn m-3">
                            <a href="{{ route('create-admin') }}" class="add-btn"><i class="fas fa-plus"></i></a>

                            <!-- Modal -->

                        </div>
                        {{-- <div class="print">
                            <a href="" class="btn btn-primary pdf">CSV</a>
                            <a href="" class="btn btn-primary pdf">Excel</a>
                             <a class="btn btn-primary pdf" href="">PDF</a>
                             <a class="btn btn-primary pdf btnprn" href="" onclick="print()">Print</a>
                        </div> --}}
                        {{-- <div class="add-btn m-3">
                            <a class="add-btn" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fas fa-plus"></i></a>
                            

                        </div> --}}

                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-borderd" id="example">
                            <thead>
                                <tr>
                                    <th>SI</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Profession</th>
                                    <th>Profession Type</th>
                                    <th>Intern Duration</th>
                                    <th>Pay Agreement</th>
                                    <th>Joining Date</th>
                                    <th>Image</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $i =1;
                                @endphp
                                @foreach($employee as $value)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$value->name}}</td>
                                    <td>{{$value->email}}</td>
                                    <td>{{$value->phone}}</td>
                                    <td>{{Str::limit($value->designation,10)}}</td>
                                    <td>{{$value->profession_type}}</td>
                                    <td>{{$value->intern_duration}}</td>
                                    <td>{{$value->pay_agreement}}</td>

                                    <td>{{ Illuminate\Support\Carbon::parse($value->joining_date)->format('d-M-Y') }}</td>


                                    <td>
                                        <img src="{{ asset($value->image) }}" height="50px" width="50px" alt="">
                                    </td>
                                    <td>
                                        <div class="action-buttons">

                                            <a class="btn btn-warning" href="{{ route('employeePrint',$value->id) }}"><i class="fas fa-print"></i></a>
                                            <a class="btn btn-dark" href="{{ route('employee.edit',$value->id) }}"><i class="fas fa-edit"></i></a>
                                            <form action="{{ route('employee.destroy', $value->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                            </form>

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

<!-- Modal -->
{{-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    @include('error')
    <form method="post" action="{{ route('employee.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Employee</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group my-2">
                        <label for="name">Name</label>
                        <input class="form-control" type="text" name="name" id="name">
                    </div>
                    <div class="form-group my-2">
                        <label for="email">Email</label>
                        <input class="form-control" type="email" name="email" id="email">
                    </div>
                    <div class="form-group my-2">
                        <label for="phone">Phone</label>
                        <input class="form-control" type="text" name="phone" id="phone">
                    </div>
                    <div class="form-group my-2">
                        <label for="emergency_phone">Emergency Phone</label>
                        <input class="form-control" type="text" name="emergency_phone" id="emergency_phone">
                    </div>
                    <div class="form-group my-2">
                        <label for="address">Address</label>
                        <input class="form-control" type="text" name="address" id="address">
                    </div>
                    <div class="form-group my-2">
                        <label for="blood_group">Blood Group</label>
                        <input class="form-control" type="text" name="blood_group" id="blood_group">
                    </div>
                    <div class="form-group my-2">
                        <label for="image">Image</label>
                        <input class="form-control" type="file" name="image" id="image">
                    </div>
                    <div class="form-group my-2">
                        <label for="designation">Designation</label>
                        <input class="form-control" type="text" name="designation" id="designation">
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="password"><strong>Password</strong></label>
                        <input type="password" id="password" name="password" placeholder="Admin Password" class="form-control my-2">
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="roles">Choose a Role:</label>
                        <select id="roles" name="user_role" class="form-control">
                            @foreach($adminCreate as $role)
                            <option value="{{ $role->id }}">{{ $role->role_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group my-2">
                        <label for="profession_type">Designation Type</label>
                        <select class="form-control" name="profession_type" id="profession_type">
                            <option value="">Select Profession Type</option>
                            <option value="intern">Intern/Probation</option>
                            <option value="permanent">Permanent</option>
                        </select>
                    </div>
                    <div class="form-group my-2">
                        <label for="intern_duration">Intern/Probation Duration</label>
                        <select class="form-control" name="intern_duration" id="intern_duration">
                            <option value="">Select Duration</option>
                            <option value="3_months">3 Months</option>
                        </select>

                    </div>

                    <div class="form-group my-2">
                        <label for="joining_date">Joining Date</label>
                        <input class="form-control" type="date" name="joining_date" id="joining_date">
                    </div>
                    <div class="form-group my-2">
                        <label for="pay_agreement">Pay agreement</label>
                        <input class="form-control" type="text" name="pay_agreement" id="pay_agreement">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </form>
</div> --}}
{{-- end modal --}}

@endsection
@push('js')
<script src="https://cdn.datatables.net/v/bs5/dt-1.13.6/datatables.min.js"></script>
<script>
    new DataTable('#example', {
        select: true
    });
</script>
@endpush
