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
                        <div class="area-h3">
                            <h2>Hold Project List</h2>
                        </div>

                        {{-- <div class="print">
                            <a href="" class="btn btn-primary pdf">CSV</a>
                            <a href="" class="btn btn-primary pdf">Excel</a>
                             <a class="btn btn-primary pdf" href="">PDF</a>
                             <a class="btn btn-primary pdf btnprn" href="" onclick="print()">Print</a>
                            </div> --}}

                    </div>
                    <table class="table table-hover table-borderd" id="example">
                        <thead>
                            <tr>
                                <th>SI</th>
                                <th>Employee Name</th>
                                <th>Title</th>
                                <th>Assign Date</th>
                                <th>Status</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 1 @endphp
                            @foreach($inactiveProjectList as $value)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $value->employee->name }}</td>
                                <td>{{ $value->title }}</td>
                                <td>{{ date('d-M-Y', strtotime($value->assign_date)) }}</td>
                                <td>
                                    @if($value->status == 'active')
                                    <a class="btn btn-success" href="{{ route('taskStatus',$value->id) }}">{{ $value->status }}</a>
                                    @elseif($value->status == 'inactive')
                                    <a class="btn btn-danger" href="{{ route('taskStatus',$value->id) }}">{{ $value->status }}</a>
                                    @endif

                                </td>

                                <td>{{ Str::limit($value->description,20) }}</td>
                                <td>
                                    <div class="action-buttons">
                                        <a class="btn btn-dark" href="{{ route('task.edit',$value->id) }}"><i class="fas fa-edit"></i></a>

                                        <form action="{{ route('task.destroy',$value->id) }}" method="POST">
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
<!--/ Hoverable Table rows -->

@endsection
@push('js')
<script src="https://cdn.datatables.net/v/bs5/dt-1.13.6/datatables.min.js"></script>
<script>
    new DataTable('#example', {
        select: true
    });

</script>
@endpush
