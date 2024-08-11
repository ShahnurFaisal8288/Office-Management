@extends('backend.partials.app')
@section('content')
@push('css')
<style>
    .customer-card{
        display: flex;
        justify-content: space-between;
    }
    .customer-container{
        margin: 0 0 310px 0 ;
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
							<h2>User Approve Table</h2> </div>
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
                                        <th>Serial Number</th>
                                        <th>Project Name</th>
                                        <th>Project Owner Name</th>
                                        <th>Project Owner's Cell No.</th>
                                        <th>Project Value</th>
                                        <th>Project Lead</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody> @foreach($investor as $value)
                                    <tr>
                                        <td>{{ $value->serial_number }}</td>
                                        <td>{{ $value->project_name }}</td>
                                        <td>{{ $value->project_owner_name }}</td>
                                        <td>{{ $value->project_owner_cell_no }}</td>
                                        <td>{{ $value->project_value }}</td>
                                        <td>{{ $value->lead }}</td>
                                        <td>{{ Carbon\Carbon::parse($value->start_date)->format('dM-Y') }}</td>
                                        <td>{{ Carbon\Carbon::parse($value->end_date)->format('dM-Y') }}</td>
                                        <td>
                                        <a href="{{ route('customer',$value->id) }}" title="Delete" class="btn btn-info" id="delete"><span class="btn btn-info">Lead</span></a> </td>
                                        <td>
                                            <a class="btn btn-danger" href="{{ route('investor_delete',$value->id) }}"><i class="fas fa-trash"></i></a>
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
