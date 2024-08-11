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
                            <h2>Maintenance List</h2>
                        </div>
                        <div class="add-btn m-3">
                            <a href="{{ route('maintenance_get') }}" class="add-btn"><i class="fas fa-plus"></i></a>

                            <!-- Modal -->

                        </div>
                        {{-- <div class="print">
                            <a href="" class="btn btn-primary pdf">CSV</a>
                            <a href="" class="btn btn-primary pdf">Excel</a>
                             <a class="btn btn-primary pdf" href="">PDF</a>
                             <a class="btn btn-primary pdf btnprn" href="" onclick="print()">Print</a>
                            </div> --}}

                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-borderd" id="example">
                            <thead>
                                <tr>
    
                                    <th>Sl</th>
                                    <th>Customer</th>
                                    <th>Maintenance Amount</th>
                                    <th>Created At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                     $i = 1;
                                @endphp
                                 @foreach($maintenance 
                             as $value)
                                <tr>
    
                                    <td>{{$i++}}</td>
                                    <td>{{$value->customer->name_or_business}}</td>
                                    <td>{{$value->maintenance_amount}} Tk.</td>
                                    <td>{{$value->created_at->format('d-M-y')}}</td>
                                    <td width="25%" style="display:flex;gap:10px;">
                                        <form action="{{ route('mantenaceDelete', $value->id) }}" method="POST">
                                            @csrf
                                           
                                            <button type="submit" class="btn btn-outline-danger"><i class="fas fa-trash"></i></button>
                                        </form>
                                        <a style="display: inline-block;" class="btn btn-dark" href="{{ route('maintenance_invoice',$value->id) }}"><i class="fas fa-print"></i></a>
                                        {{-- <a style="display: inline-block;" class="btn btn-secondary" href="{{ route('invoice.show',$value->id) }}"><i class="fas fa-eye"></i></a>
                                        <a style="display: inline-block;" class="btn btn-warning" href="{{ route('bookingInvoice',$value->id) }}"><i class="fas fa-receipt"></i></a> --}}
                                    </td>
                                </tr> @endforeach </tbody>
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
