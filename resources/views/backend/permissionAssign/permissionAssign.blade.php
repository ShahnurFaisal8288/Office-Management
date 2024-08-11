@extends('backend.partials.app')
@push('css')
<style>
     h3, h1, h2, h5, p, td, th, table, tr span{
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
@section('title')
Assign Permission
@endsection
@section('content')

<!-- Hoverable Table rows -->
<div class="contasiner customer-container">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-head mx-5 my-3 customer-card">
                    <a href="{{route('add-assign-permission')}}" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Create Assign Permission </a>

                </div>
                <div class="card-body" style="background: #a8cc66;">
                    <h3 class="card-header text-center">Assign Permission Table</h3>
                    <table class="table table-hover table-borderd">
                        <thead>
                            <tr>
                                <th>SI</th>
                                <th>Role Name</th>
                                <th>Permission Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 1 @endphp

                            @forelse ($role as $item)
                            <tr>
                                <td>{{$i++}}</td>

                                <td> {{ $item->role_name }}</td>
                                <td> @foreach($item->permissions as $permission)
                                    <button class="btn btn-sm btn-success"><span style="font-size:10px;"> {{$permission->permission_name}} </span></button>
                                    @endforeach
                                </td>
                                <td>
                                    <a href="{{ route('showEdit-assign-permission',$item->id) }}" title="Edit" class="btn btn-primary"><i class="fa-regular fa-pen-to-square"></i></a>
                                    <a href="{{ route('delete-assign-permission',$item->id) }}" title="Delete" class="btn btn-danger" id="delete"><i class="fa-solid fa-trash"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $role->links() }}

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
