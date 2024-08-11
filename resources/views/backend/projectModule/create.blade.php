@extends('backend.partials.app')
@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .showinline {
        display: inline-block;
    }
</style>
@endpush

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-lg-12 mb-4 order-0">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-12">
                        <div class="card-body">
                            @include('error')
                            <form method="post" action="{{route('projectModule.store')}}">
                                @csrf
                                <div class="row">
                                    <div class="col-xxl">
                                        <div class="card mb-2">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between">
                                                    <div>
                                                        <h2>Project Module Create</h2>
                                                    </div>
                                                    <div class="list">
                                                        <a class="btn btn-info" href="{{route('projectModule.index')}}"><i class="fas fa-plus"></i>Module List</a>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="show_transaction">
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
                                                        <div class="col-md-2 mb-3">
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
                                                <div class="">
                                                    <input type="submit" value="Add" class="btn btn-primary w-25" id="add_btn">
                                                </div>
                                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@endsection

@push('js')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
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
                                                        <div class="col-md-2 mb-3">
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