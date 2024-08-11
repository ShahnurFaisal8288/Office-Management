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
                            <h2>Task Update</h2>
                        </div>
                        {{-- <div class="print">
                            <a href="" class="btn btn-primary pdf">CSV</a>
                            <a href="" class="btn btn-primary pdf">Excel</a>
                             <a class="btn btn-primary pdf" href="">PDF</a>
                             <a class="btn btn-primary pdf btnprn" href="" onclick="print()">Print</a>
                        </div> --}}
                        {{-- @php
                        $userRole = Auth::guard('admin')->user()->user_role;
                        if ($userRole == 1 ) {
                        @endphp --}}
                        <div class="add-btn m-3">
                            <a class="add-btn" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fas fa-plus"></i></a>
                        </div>
                        {{-- @php
                            }
                        @endphp --}}
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-borderd" id="example">
                            <thead>

                                <tr>
                                    <th>SI</th>
                                    <th>task_id</th>
                                    <th>employee_id</th>
                                    <th>description</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 1 @endphp
                                @foreach($taskUpdate as $value)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $value->task->title ?? '' }}</td>
                                    <td>{{ $value->employee->name ?? '' }}</td>
                                    <td>{{ Str::limit($value->description,10) }}</td>
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
    <form action="{{ route('taskUdate.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        {{-- @method('PUT') --}}
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Employee</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    
                    
                    <div class="form-group my-2">
                        <label for="task_id">task</label>
                        <select class="form-control" name="task_id" id="task_id">
                            <option value="">Select</option>
                            @foreach ($task as $value)
                            <option value="{{ $value->id }}">{{ $value->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group my-2">
                        <label for="description">Description</label>
                        <textarea class="form-control" name="description" id="description" cols="30" rows="10"></textarea>
                    </div>
                    <div class="form-group my-2">
                        <label for="taskStatus">Status</label>
                        <select class="form-control" name="taskStatus" id="taskStatus">
                            <option value="">Select</option>
                            <option value="pending">pending</option>
                            <option value="complete">complete</option>
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
@endpush
