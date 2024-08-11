@extends('backend.partials.app')
@section('content')
@push('css')
<style>
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
                            <h2>Payment List</h2>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-borderd" id="example">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    {{-- <th>From Month</th>
                                    <th>To Month</th> --}}
                                    <th>total</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody> @foreach($investorPay as $item)
                                <tr>
                                    <td>{{ $item->customers->name_or_business ?? '' }}</td>
                                    {{-- <td>{{$investors->start_month}}</td>
                                    <td>{{$investors->end_month}}</td> --}}
                                    <td>{{$item->total}}</td>
                                    <td>
                                        <a class="btn btn-danger" href="{{ route('investorPay_delete',$item->id) }}"><i class="fas fa-trash"></i></a>
                                        <a class="btn btn-primary" href="{{ route('investorPay_print',$item->id) }}"><i class="fas fa-print"></i></a>
                                        <a class="btn btn-primary" href="{{ route('investorPay_View',$item->id) }}"><i class="fas fa-eye"></i></a>
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

@endsection
@push('js')
<script src="https://cdn.datatables.net/v/bs5/dt-1.13.6/datatables.min.js"></script>
<script>
    new DataTable('#example', {
        select: true
    });

</script>
@endpush
