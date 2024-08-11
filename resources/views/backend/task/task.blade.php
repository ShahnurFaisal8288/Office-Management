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
    white-space: nowrap;
}

.action-buttons a {
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
                            <h2>Task</h2>
                        </div>

                        @php
                        $userRole = Auth::guard('admin')->user()->user_role;
                        if ($userRole == 1 ) {
                        @endphp
                        <div class="add-btn m-3">
                            <a class="add-btn" data-bs-toggle="modal" data-bs-target="#exampleModal"><i
                                    class="fas fa-plus"></i></a>
                        </div>
                        @php
                        }
                        @endphp
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-borderd" id="example">
                            <thead>

                                <tr>
                                    <th>SI</th>
                                    <th>Employee Name</th>
                                    <th>Project/Client</th>
                                    <th>Assign Date</th>
                                    <th>End Date</th>
                                    @php
                                    $userRole = Auth::guard('admin')->user()->user_role;
                                    if ($userRole == 1 ) {
                                    @endphp
                                    <th>Status</th>
                                    @php
                                    }
                                    @endphp
                                    {{-- <th>Description</th> --}}
                                    @php
                                    $userRole = Auth::guard('admin')->user()->user_role;
                                    if ($userRole == 1) {
                                    @endphp
                                    <th>Actions</th>
                                    @php
                                    }
                                    @endphp
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 1 @endphp
                                @foreach($task as $value)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $value->employee->name ?? '' }}</td>
                                    <td>{{ $value->customer->name_or_business ?? '' }}</td>
                                    <td>{{ date('d-M-Y', strtotime($value->assign_date)) }}</td>
                                    <td>{{ date('d-M-Y', strtotime($value->end_date)) }}</td>
                                    @php
                                    $userRole = Auth::guard('admin')->user()->user_role;
                                    if ($userRole == 1 ) {
                                    @endphp
                                    <td>
                                        @if($value->status == 'active')
                                        <a class="btn btn-success" href="{{ route('taskStatus',$value->id) }}">Active To
                                            Inactive</a>
                                        @elseif($value->status == 'inactive')
                                        <a class="btn btn-danger" href="{{ route('taskStatus',$value->id) }}">Inactive
                                            to Active</a>
                                        @endif

                                    </td>
                                    @php
                                    }
                                    @endphp
                                    {{-- <td>{{ Str::limit($value->description,20) }}</td> --}}
                                    @php
                                    $userRole = Auth::guard('admin')->user()->user_role;
                                    if ($userRole == 1) {
                                    @endphp
                                    <td>
                                        <div class="action-buttons">
                                            <a class="btn btn-dark" href="{{ route('task.edit',$value->id) }}"><i
                                                    class="fas fa-edit"></i></a>
                                            <a class="btn btn-info " data-bs-toggle="modal"
                                                data-bs-target="#detailsModal{{$value->id}}"><i
                                                    class="fas fa-eye text-white"></i></a>

                                            <!--details Modal -->
                                            <div class="modal fade" id="detailsModal{{$value->id}}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Task
                                                                Details
                                                            </h1>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="title"><strong>Task</strong></label><br>
                                                                <hr>
                                                                @foreach($value->taskDetails as $taskDetail)
                                                                {{ $taskDetail->title }}<br>
                                                                @endforeach
                                                                <hr>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="status"><strong>Status</strong></label><br>
                                                                <hr>
                                                                @foreach($value->taskDetails as $taskDetail)
                                                                {{ $taskDetail->status }}<br>
                                                                @endforeach

                                                            </div>
                                                            <hr>
                                                            <div class="form-group">
                                                                <label for="title"><strong>Task Info</strong></label><br>
                                                                <hr>
                                                                @foreach($value->taskDetails as $taskDetail)
                                                                {{ $taskDetail->remarks }}<br>
                                                                @endforeach
                                                               
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <form action="{{ route('task.destroy',$value->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"><i
                                                        class="fas fa-trash"></i></button>
                                            </form>
                                        </div>

                                    </td>
                                    @php
                                    }
                                    @endphp
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
    <form action="{{ route('task.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Task</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group my-2">
                        <label for="title">Projects/Clients</label>
                        <select class="form-control" name="customer_id" id="customer_id">
                            <option value="">Choose Project/Client</option>
                            @foreach($customer as $value)
                            <option value="{{ $value->id }}">{{ $value->name_or_business }}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="form-group my-2">
                        <label for="">Employee</label>
                        <select class="form-control" name="employee_id" id="employee_id">
                            <option value="">Choose Employee</option>
                            @foreach($employee as $value)
                            <option value="{{ $value->authId }}">{{ $value->name }}</option>
                            @endforeach

                        </select>
                    </div>

                    <!-- <div class="form-group my-2">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" name="title" id="title" multiple>
                    </div> -->

                    <div class="table-responsive">
                        <table class="table table-bordered" id="articles">
                            <label for="title">Title</label>
                            <tr>
                                <td><input type="text" id="
                                " name="title[]" placeholder="Title" class="form-control name_list" /></td>
                                <td><button type="button" name="add" id="add" class="btn btn-success">Add new</button>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="form-group my-2">
                        <label for="description">Description</label>
                        <textarea class="form-control" name="description" id="description" cols="30"
                            rows="10"></textarea>
                    </div>
                    <div class="form-group my-2">
                        <label for="assign_date">Assign Date</label>
                        <input type="date" class="form-control" name="assign_date" id="assign_date">
                    </div>
                    <div class="form-group my-2">
                        <label for="end_date">End Date</label>
                        <input type="date" class="form-control" name="end_date" id="end_date">
                    </div>
                    <div class="form-group my-2">
                        <label for="status">Status</label>
                        <select class="form-control" name="status" id="status">
                            <option value="">Choose Status</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
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
<script src="https://cdn.datatables.net/v/bs5/dt-1.13.6/datatables.min.js"></script>
<script>
new DataTable('#example', {
    select: true
});
</script>
<script>
$(document).ready(function() {
    var i = 1;
    $('#add').click(function() {
        i++;
        $('#articles').append('<tr id="row' + i +
            '"><td><input type="text" id="quantity" name="title[]" placeholder="quantity" class="form-control name_list" /></td><td><button type="button" name="remove" id="' +
            i + '" class="btn btn-danger btn_remove">X</button></td></tr>');
    });

    $(document).on('click', '.btn_remove', function() {
        var button_id = $(this).attr("id");
        $('#row' + button_id + '').remove();
    });

    $('#submit').click(function() {
        //alert($('#add_name').serialize()); //alerts all values and works fine          
        $.ajax({
            url: "wwwdb.php",
            method: "POST",
            data: $('#add_name').serialize(),
            success: function(data) {
                $('#add_name')[0].reset();
            }
        });
    });

    function upd_art() {
        var qty = $('#quantity').val();
        var price = $('#price').val();
        var total = (qty * price).toFixed(2);
        $('#total').val(total);
    }
    setInterval(upd_art, 1000);
});
</script>
@endpush