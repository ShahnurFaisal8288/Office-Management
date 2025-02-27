@extends('backend.partials.app')
@section('title')
Permission
@endsection
@section('content')
@push('css')
<link href="https://cdn.datatables.net/v/bs5/dt-1.13.6/datatables.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<style>
    h3,
    h1,
    h2,
    h5,
    p,
    td,
    th,
    table,
    tr span {
        color: black
    }

    th {
        color: #fff !important;
    }

    tr:nth-child(odd) td:hover {
        color: white;

    }

    tr:nth-child(even) td:hover {
        color: white;

    }
</style>
@endpush
<!-- Hoverable Table rows -->
<div class="contasiner customer-container">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body" style="background: #a8cc66;">
                    <div class="customer-card mb-3" style="margin-top:-10px;">
                        <div class="area-h3">
                            <h2>Permission List</h2>
                        </div>

                        <div class="btn-customer" style="margin-top:10px;">
                            <a href="{{route('add-permission')}}" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Add Permission</a>

                        </div>
                    </div>
                    <table class="table table-hover table-borderd" id="example">
                        <thead>
                            <tr>
                                <th>SI</th>
                                <th>Module Name</th>
                                <th>Sub Module Name</th>
                                <th>Permission Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 1 @endphp
                            @foreach($permission as $permissions)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$permissions->modules->module_name ?? ''}}</td>
                                <td>{{$permissions->subModules->subModule_name ?? ''}}</td>
                                <td>{{$permissions->permission_name}}</td>
                                <td>
                                    <a href="{{route('edit.permission',$permissions->id)}}" title="Edit" class="btn btn-primary"><i class="fa-regular fa-pen-to-square"></i></a>
                                    <a href="{{route('delete.permission',$permissions->id)}}" title="Delete" class="btn btn-danger" id="delete"><i class="fa-solid fa-trash"></i></a>
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