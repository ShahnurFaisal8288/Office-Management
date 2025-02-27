@extends('backend.partials.app')
@section('title')
    Module
@endsection
@section('content')
@push('css')
<link href="https://cdn.datatables.net/v/bs5/dt-1.13.6/datatables.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css"> 
@endpush
    <div class="container offer-container">
        <div class="row margin-offer">
            <div class="col-lg-12">
                
                <div class="card">
                    <div class="card-body">
                    <div class="customer-card mb-3" style="margin-top:-10px;">
						<div class="area-h3">
							<h2>Module List</h2> </div>
						
						<div class="btn-customer" style="margin-top:10px;">
                        <a href="{{route('add.module')}}" class="btn btn-primary" title="Add Role" ><i class="fa-solid fa-plus"></i> Add Module</a>

						</div>
                        </div>
                        <table class="table table-hover table-bordered" id="example">
                            <thead>
                            <tr>
                                <th>SI</th>
                                <th>Title</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $i = 1 @endphp
                            @foreach($module as $modules)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$modules->module_name}}</td>
                                    <td>
                                        <a href="{{route('edit.module',$modules->id)}}" title="Edit" class="btn btn-primary"><i class="fa-regular fa-pen-to-square"></i></a>
                                        <a href="{{route('delete.module',$modules->id)}}" title="Delete" class="btn btn-danger" id="delete"><i class="fa-solid fa-trash"></i></a>
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
@endsection
@push('js')
	<script src="https://cdn.datatables.net/v/bs5/dt-1.13.6/datatables.min.js"></script>
	<script>
	new DataTable('#example', {
		select: true
	});
	</script> 
@endpush



