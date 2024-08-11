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
                            <h2>Expense List</h2>
                        </div>
                        <div class="add-btn m-3">
                            <a href="{{ route('expenseCreate') }}" class="add-btn"><i class="fas fa-plus"></i></a>
                        </div>
                    </div>
                    <div class="report mb-5">
                        <form action="/expensePost/list" method="GET">

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
                    <table class="table table-hover table-borderd" id="example">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Note</th>
                                <th>Total Amount</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody> @foreach($expense as $value)
                            <tr>

                                <td>{{ \Carbon\Carbon::parse($value->date)->format('d-M-y') }}</td>
                                <td>{{Str::limit($value->note,20)}}</td>
                                <td>{{$value->totalAmount}}</td>
                                <td width="25%" style="display:flex;gap:10px;">
                                    <a style="display: inline-block;" class="btn btn-secondary" href="{{ route('expense.edit',$value->id) }}"><i class="fas fa-eye"></i></a>
                                    <form action="{{ route('expenseDestroy', $value->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                    </form>
                                    {{-- <a style="display: inline-block;" class="btn btn-dark" href="{{ route('invoicePdf',$value->id) }}"><i class="fas fa-print"></i></a> --}}

                                    {{-- <a style="display: inline-block;" class="btn btn-warning" href="{{ route('bookingInvoice',$value->id) }}"><i class="fas fa-receipt"></i></a> --}}
                                </td>
                            </tr> @endforeach
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