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

    .action-buttons {
        display: flex;
        white-space: nowrap;
    }

    .action-buttons a {
        margin-right: 5px;

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
                        <div class="area-h3 m-3">
                            <h3>Project Module</h3>
                        </div>
                        <div class="add-btn m-3">
                            <a class="add-btn" href="{{route('projectModule.create')}}"><i class="fas fa-plus"></i></a>
                        </div>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-hover table-borderd" id="example">
                            <thead>
                                <tr>
                                    <th>SI</th>
                                    <th>Project</th>
                                    <th>Module</th>
                                    <th>Features</th>
                                    <th>Details</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 1 @endphp
                                @foreach($projectModule as $value)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $value->projectCreate->project_name ?? '' }}</td>
                                    <td>{{ $value->module_name }}</td>
                                    <td>{{ $value->features }}</td>
                                    <td>{{ Str::limit($value->details,10) }}</td>
                                    <td>
                                        <div class="action-buttons">
                                            <a class="btn btn-info" href="{{route('projectModule.edit',$value->id)}}"><i class="fas fa-eye text-white"></i></a>
                                           
                                            {{-- end modal --}}
                                            <form action="{{ route('projectModule.destroy',$value->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </div>
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

<!-- project Modal -->
<div class="modal fade" id="projectModuleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="{{route('projectModule.store')}}" method="post">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Module Create</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-2 mb-3">
                            <label for="project_id" class="form-label">Project</label>
                            <select class="form-control" name="project_id[]" id="project_id">
                                <option value="">Select</option>
                                @foreach($project as $value)
                                <option value="{{ $value->id }}">{{ $value->project_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-1 mb-3">
                            <label for="module_name" class="form-label">Module Name</label>
                            <input class="form-control module_name" type="module_name" name="module_name[]">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="features" class="form-label">Features</label>
                            <input class="form-control features" type="text" name="features[]">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="details" class="form-label">Details</label>
                            <textarea class="form-control details" name="details[]" id="details"></textarea>
                        </div>
                        <div class="col-md-1 mt-4">
                            <button class="btn btn-success add_item_btn">Add</button>
                        </div>
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
{{-- end modal --}}

@endsection
@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/v/bs5/dt-1.13.6/datatables.min.js"></script>
<script>
    new DataTable('#example', {
        select: true
    });
</script>
<script>
    $(document).ready(function() {
        $(".add_item_btn").click(function(e) {
            e.preventDefault();
            $(".show_transaction").prepend(` <div class="row">
                                                        <div class="col-md-2 mb-3">
                                                            <label for="project_id" class="form-label">Project</label>
                                                            <select class="form-control" name="project_id[]" id="project_id">
                                                                <option value="">Select</option>
                                                                @foreach($project as $value)
                                                                <option value="{{ $value->id }}">{{ $value->project_name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-1 mb-3">
                                                            <label for="module_name" class="form-label">Module Name</label>
                                                            <input class="form-control module_name" type="module_name" name="module_name[]">
                                                        </div>
                                                        <div class="col-md-3 mb-3">
                                                            <label for="features" class="form-label">Features</label>
                                                            <input class="form-control features" type="text" name="features[]">
                                                        </div>
                                                        <div class="col-md-3 mb-3">
                                                            <label for="details" class="form-label">Details</label>
                                                            <textarea class="form-control details" name="details[]" id="details"></textarea>
                                                        </div>
                                                        <div class="col-md-1 mt-4">
                                                            <button class="btn btn-danger remove_item_btn">Remove</button>
                                                        </div>
                                                    </div>`);
        });
        $(document).on('click', '.remove_item_btn', function(e) {
            let row_item = $(this).parent().parent();
            $(row_item).remove();
        });
    });
</script>
@endpush