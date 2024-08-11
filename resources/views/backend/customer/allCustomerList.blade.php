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
                            <h2>All Client List</h2>
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
                                <th>Serial No.</th>
                                <th>Name of Bussiness or Person</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Turn to Maintenance</th>
                                <th>Address</th>
                                {{-- <th>Payable</th>
                                <th>Paid Amount</th>
                                <th>Due Amount</th> --}}

                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody> @foreach($customer as $value)
                            <tr>
                                <td>{{$value->serial_number}}</td>
                                <td>{{$value->name_or_business}}</td>
                                <td>{{$value->name}}</td>
                                <td>{{$value->phone}}</td>
                                <td>
                                    @if($value->status)
                                    <a class="btn btn-outline-success">{{ $value->status }}</a>
                                    @endif
                                </td>
                                <td>{{Str::limit($value->address,10)}}</td>
                                {{-- <td>{{$value->invoices->total_amount}}</td>
                                <td>{{$value->total_paid + $value->invoices->advance}}</td>
                                <td>{{$value->invoices->total_amount - $value->total_paid -$value->invoices->advance}}</td> --}}
                                <td>
                                <a class="btn btn-outline-success" href="{{ route('customer.edit',$value->id) }}"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('customerDelete', $value->id) }}" method="post">
                                 @csrf
                                 {{-- @method('DELETE') --}}
                                <button type="submit" class="btn btn-outline-danger"><i class="fas fa-trash"></i></button>
                                </form>
                                </td>
                            </tr> @endforeach </tbody>
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
