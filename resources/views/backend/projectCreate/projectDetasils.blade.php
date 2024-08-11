@extends('backend.partials.app')
@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .showinline {
        display: inline-block;
    }

    .value-item {
        display: inline-block;
        padding: 5px;
        margin: 5px 5px 0 0;
        background-color: #e9ecef;
        border: 1px solid #ced4da;
        border-radius: 4px;
    }

    .value-item .remove-feature {
        margin-left: 10px;
        cursor: pointer;
        color: #dc3545;
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
                            <form method="post" action="{{ route('projectDetails.store', $project->id) }}">
                                @csrf
                                <div class="row">
                                    <div class="col-xxl">
                                        <div class="card mb-2">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between">
                                                    <div>
                                                        <h2>Project Update</h2>
                                                    </div>
                                                    <div class="list">
                                                        <a class="btn btn-info" href="{{ route('projectCreate.index') }}"><i class="fas fa-plus"></i> Project List</a>
                                                    </div>
                                                </div>
                                                <hr>
                                             <div class="row">
                                                <div class="col-md-4 mb-3">
                                                    <label for="project_id" class="form-label">Project Name</label>
                                                    <input type="text" class="form-control" id="project_name" value="{{ $project->project_name }}" readonly>
                                                    <input type="hidden" name="project_id" value="{{ $project->id }}">
                                                    
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="project_id" class="form-label">Hours</label>
                                                    <input type="text" class="form-control" id="project_name" value="{{ $project->hour }}" readonly>
                                                </div>
                                             </div>
                                                <div class="show_transaction">
                                                    <div class="row">
                                                        <div class="col-md-2 mb-3">
                                                            <label for="module_name" class="form-label">Module Name</label>
                                                            <input class="form-control module_name" type="text" name="module_name[]" value="">
                                                        </div>
                                                        <div class="col-md-3 mb-3">
                                                            <label for="features" class="form-label">Features</label>
                                                            <input class="form-control features-input" type="text" placeholder="Enter features">
                                                            <div class="features-container mt-2"></div>
                                                            <input type="hidden" name="features[]" class="features-hidden">
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
            $(".show_transaction").prepend(`
                <div class="row">
                    <div class="col-md-2 mb-3">
                        <label for="module_name" class="form-label">Module Name</label>
                        <input class="form-control module_name" type="text" name="module_name[]">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="features" class="form-label">Features</label>
                        <input class="form-control features-input" type="text" placeholder="Enter features">
                        <div class="features-container mt-2"></div>
                        <input type="hidden" name="features[]" class="features-hidden">
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
            e.preventDefault();
            $(this).closest('.row').remove();
        });

        $(document).on('keypress', '.features-input', function(event) {
            if (event.which == 13) {
                event.preventDefault();
                var input = $(this);
                var value = input.val().trim();
                if (value) {
                    addFeature(input, value);
                    input.val('');
                }
            }
        });

        $(document).on('click', '.remove-feature', function() {
            var container = $(this).closest('.features-container');
            $(this).parent().remove();
            updateHiddenInput(container);
        });

        function addFeature(input, value) {
            var container = input.siblings('.features-container');
            var featureItem = $('<div class="value-item"></div>').text(value);
            var removeButton = $('<span class="remove-feature">&times;</span>');
            featureItem.append(removeButton);
            container.append(featureItem);
            updateHiddenInput(container);
        }

        function updateHiddenInput(container) {
            var features = [];
            container.find('.value-item').each(function() {
                features.push($(this).text().replace('×', '').trim());
            });
            container.siblings('.features-hidden').val(JSON.stringify(features));
        }
    });

</script>
@endpush
