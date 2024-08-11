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
    <div class="row mt-3">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-head text-center pt-2">
                    <h4>Salary Status</h4>
                </div>
                <div class="card-body">
                    <table class="table-responsive table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Amount</th>
                                <th>Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($salary as $value)
                            <tr>
                                <td>{{ $value->employee->name }}</td>
                                <td>{{ $value->amount }}</td>
                                <td>{{ $value->created_at->format('d-M-y') }}</td>
                                <td>
                                    <a class="btn btn-outline-warning" href="{{ route('salaryUpdate',$value->id) }}">{{ $value->status }}</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-6"></div>
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
