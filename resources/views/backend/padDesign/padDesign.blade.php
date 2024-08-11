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

<body style="font-family: Open Sans, sans-serif; font-size: 100%; font-weight: 400; line-height: 1.4; color: #000;">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-12 col-xl-12 col-sm-12">
                <div class="card">
                    <div class="card-head">
                        <div class="d-flex justify-content-between m-3">
                            <h2>Pad List</h2>
                            <a href="{{ route('create.pad') }}" class="btn btn-info text-white">Create Pad</a>
                        </div>
                    </div>
                    <hr>
                    <div class="card-body">
                        <table class="table table-hover table-bordered" id="example">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Title</th>
                                    <th>Pad Body</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i=1 @endphp
                                @foreach($padDesign as $item)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{!! html_entity_decode($item->title) !!}</td>
                                    <td>{!! html_entity_decode(Str::limit($item->padBody,10)) !!}</td>
                                    <td>
                                        <a href="{{route('pad.pdf',$item->id)}}" class="btn btn-info text-white"><i class="fa fa-eye"></i></a>
                                        <a href="{{route('padDesign.edit',$item->id)}}" class="btn btn-secondary"><i class="fa fa-edit"></i></a>
                                        <a href="{{route('padDesign.delete',$item->id)}}" id="delete" class="btn btn-danger"><i class="fa fa-trash"></i></a>
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