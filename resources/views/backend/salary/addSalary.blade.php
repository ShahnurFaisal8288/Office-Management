@extends('backend.partials.app')
@section('content')
@push('css')
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.dataTables.css"/>
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
    .action-buttons{
        display: flex;
        white-space: nowrap;
    }
    .action-buttons a{
        margin-right: 5px;

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
                            <h2>Salary List</h2>
                        </div>
                        {{-- <div class="print">
                            <a href="" class="btn btn-primary pdf">CSV</a>
                            <a href="" class="btn btn-primary pdf">Excel</a>
                             <a class="btn btn-primary pdf" href="">PDF</a>
                             <a class="btn btn-primary pdf btnprn" href="" onclick="print()">Print</a>
                        </div> --}}
                        
                        <div class="add-btn m-3">
                            <a class="add-btn" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fas fa-plus"></i></a>
                        </div>
                    </div>
                    <div class="report mb-5">
                    <form action="/salary" method="GET">
                        <div class="col-md-12 d-flex">
                            <div class="col-lg-3 col-xl-3 col-md-3 col-sm-3 col-3" style="padding: 0 0px 0 5px">
                                <input class="form-control" type="date" name="from_date">
                            </div>
                            <div class="col-lg-3 col-xl-3 col-md-3 col-sm-3 col-3" style="padding: 0 0px 0 5px">
                                <input class="form-control" type="date" name="to_date">
                            </div>

                            <div class="col-lg-3 col-xl-3 col-md-3 col-sm-3 col-3">
                                <input class="btn btn-secondary mx-2" type="submit" value="Search">

                            </div>
                        </div>
                    </form>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-borderd" id="example">
                            <thead>
                                <tr>
                                    <th>SI</th>
                                    <th>Name</th>
                                    <th>Designation</th>
                                    <th>Date</th>
                                    <th>Deleverables</th>
                                    <th>Remarks</th>
                                    <th>Status</th>
                                    {{-- <th>Action</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                // use Carbon\Carbon;
                                // $currentDate = Carbon::now();
                                $i = 1; 
                                @endphp
                                @foreach($salary as $value)
                                {{-- @php
                                    $endDate = Carbon::parse($value->endDate);
                                    $isCloseToEnd = $currentDate->diffInDays($endDate,false) <=7 && $currentDate->diffInDays($endDate,false) >=0;
                                @endphp --}}
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $value->employee->name }}</td>
                                    <td>{{ $value->employee->designation }}</td>
                                    <td>{{ $value->created_at->format('d-M-y') }}</td>
                                    <td>{{ $value->deliverables }}</td>
                                    <td>{{ $value->remarks }}</td>
                                    <td>{{ $value->status }}</td>
                                    {{-- <td>
                                        <div class="action-buttons">
                                            <a class="btn btn-dark" href="{{ route('domain.edit',$value->id) }}"><i class="fas fa-edit"></i></a>

                                        <form action="{{ route('domain.destroy',$value->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                        </form>
                                        </div>
                                    </td> --}}
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
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    @include('error')
    <form method="post" enctype="multipart/form-data">
        @csrf
        {{-- @method('PUT') --}}
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Salary</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group my-2">
                        <label for="employee_id">Employee</label>
                        <select class="form-control" name="employee_id" id="employee_id">
                            <option value="">Select</option>
                            @foreach($employee as  $value)
                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group my-2">
                        <label for="amount">Amount</label>
                        <input type="number" class="form-control" name="amount" id="amount">
                    </div>
                    <div class="form-group my-2">
                        <label for="deliveravbles">Deliveravbles</label>
                        <textarea class="form-control" name="deliverables" id="deliverables" ></textarea>
                    </div>
                    <div class="form-group my-2">
                        <label for="remarks">Remarks</label>
                        <textarea class="form-control" name="remarks" id="remarks" ></textarea>
                    </div>
                   
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </form>
</div>
{{-- end modal --}}

@endsection
@push('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/v/bs5/dt-1.13.6/datatables.min.js"></script>
<script>
    // new DataTable('#example', {
    //     select: true
    //     layout: {
    //     topStart: {
    //         buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
    //     }
    // }
    // });
    //ajax
    $(document).ready(function () {
    $('#employee_id').change(function () {
        var employee_id = $(this).val();
        console.log('Selected Employee ID:', employee_id);

        $.ajax({
            url: '/get-Amount',
            type: 'post',
            dataType: 'json',
            data: { 
                'employee_id': employee_id,
                '_token': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                console.log('Received Data:', data);
                $('#amount').val(data.amount.pay_agreement);
                $('#deliverables').val(data.title);
            },
            error: function (xhr, status, error) {
                console.error('Error:', xhr.responseText);
            }
        });
    });
});


</script>
@endpush
