@extends('backend.partials.app')
@section('title')
@endsection
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
                            <h2>Notice Board</h2>
                        </div>
                        <div class="add-btn m-3">
                            <a class="add-btn" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fas fa-plus"></i></a>
                        </div>
                    </div>
                    <table class="table table-hover table-borderd" id="example">
                        <thead>
                            <tr>
                                <th>Sl No</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Created At</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 1 @endphp
                            @foreach($notice as $item)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->description }}</td>
                                <td>{{ $item->created_at->format('d-M-y') }}</td>
                                <td>
                                    <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal{{$item->id}}" style="display:inline-block;color:white;"><i class="fa fa-edit"></i></a>
                                    <!--Update Modal -->
                                    <div class="modal fade" id="editModal{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <form action="{{route('notice.update',$item->id)}}" method="post">
                                                @csrf
                                                @method('put')
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Update Notice</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="title">Title</label>
                                                            <input type="text" id="title" name="title" value="{{$item->title}}" class="form-control my-2">
                                                            <label for="description">Description</label>
                                                            <textarea name="description" id="description" class="form-control my-2">{{$item->description}}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!--End Modal -->
                                    <form action="{{route('notice.destroy',$item->id)}}" method="post" style="display:inline-block;">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger" type="submit" id="delete" style="display:inline-block;"><i class="fa fa-trash"></i></button>
                                    </form>
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

<!--Create Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{route('notice.store')}}" method="post">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Create Notice</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" id="title" name="title" class="form-control my-2">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control my-2"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </form>
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