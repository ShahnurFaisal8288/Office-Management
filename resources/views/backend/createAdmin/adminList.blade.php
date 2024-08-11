@extends('backend.partials.app')

@section('title', 'Admin List')

@section('content')

@push('css')
<link href="https://cdn.datatables.net/v/bs5/dt-1.13.6/datatables.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
@endpush

<div class="container offer-container">
    <div class="row margin-offer">
        <div class="col-lg-12">
            @include('error')
            <div class="card">
                <div class="card-body">
                    <div class="customer-card mb-3 d-flex justify-content-between" style="margin-top:-10px;">
                        <h2>Admin & Staff List</h2>
                        <div class="btn-customer" style="margin-top:10px;">
                            <a href="{{ route('create-admin') }}" class="btn btn-primary" title="Add Category">
                                <i class="fa-solid fa-plus"></i> Create Admin Or staffs
                            </a>
                        </div>
                    </div>
                    <table class="table table-hover table-bordered" id="example">
                        <thead>
                            <tr>
                                <th>SI</th>
                                <th>Name</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @php $i = 1 @endphp --}}
                            @foreach($list as $key => $lists)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $lists->name }}</td>
                                <td>{{ $lists->role->role_name }}</td>
                                {{-- <td>{{ $lists->phone }}</td> --}}
                                <td>
                                    <a href="{{ route('showEditAdmin',$lists->id) }}" title="Edit" class="btn btn-primary">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </a>
                                    <a href="{{ route('deleteAdmin',$lists->id) }}" title="Delete" class="btn btn-danger" id="delete">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
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
