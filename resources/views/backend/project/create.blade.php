@extends('backend.partials.app')

@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet"/>
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
                            <form method="post" action="{{route('project.store')}}">
                                @csrf
                                <div class="row">
                                    <div class="col-xxl">
                                        <div class="card mb-2">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between">
                                                    <div>
                                                        <h2>Project Assign Create</h2>
                                                    </div>
                                                    <div class="list">
                                                        <a class="btn btn-info" href="{{route('project.index')}}"><i class="fas fa-plus"></i>Project Assign List</a>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row my-3 d-flex">
                                                    <div class="col-lg-4">
                                                        <label for="project_id"><strong>Project Name</strong></label>
                                                        <select name="projectCreate_id" id="project_id" class="form-control my-2 select2">
                                                            <option value="">Select</option>
                                                            @foreach($project as $item)
                                                            <option value="{{$item->id}}">{{ $item->project_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="show_transaction">
                                                    <div class="row item-row">
                                                        <div class="col-md-2 mb-3">
                                                            <label class="form-label">Module</label>
                                                            <select class="form-control module-select select2" name="project_module_id[]">
                                                                <option value="">Select</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-3 mb-3">
                                                            <label class="form-label">Features</label>
                                                            <select class="form-control features-select select2" name="features[0][]" multiple>
                                                                <option value="">Select</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-3 mb-3">
                                                            <label class="form-label">Description</label>
                                                            <textarea class="form-control" name="details[]"></textarea>
                                                        </div>
                                                        <div class="col-md-1 mb-3">
                                                            <label class="form-label">Hours</label>
                                                            <input class="form-control" type="text" name="hours[]">
                                                        </div>
                                                        <div class="col-md-2 mb-3">
                                                            <label class="form-label">Employee</label>
                                                            <select class="form-control select2" name="employee_id[0][]" multiple>
                                                                <option value="">Select</option>
                                                                @foreach($employee as $value)
                                                                <option value="{{ $value->id }}">{{ $value->name }}</option>
                                                                @endforeach
                                                            </select>
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
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
<script>
    $(document).ready(function() {
        // Initialize Select2
        $('.select2').select2();

        // Event delegation for project_id change
        function loadModules(project_id, $moduleSelect) {
            if (!project_id) {
                $moduleSelect.html('<option value="">Select</option>');
                return;
            }
            $.ajax({
                url: '{{ route('getModule') }}',
                type: 'GET',
                dataType: 'json',
                data: { project_id: project_id },
                success: function(data) {
                    console.log('Modules data:', data);
                    $moduleSelect.html(data);
                     $.each(data, function(index, value) {
                        $moduleSelect.append('<option value="'+value.id+'">'+value.name+'</option>');
                    });
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', xhr.responseText);
                }
            });
        }

        function loadFeatures(module_id, $featuresSelect) {
            if (!module_id) {
                $featuresSelect.html('<option value="">Select</option>');
                return;
            }
            $.ajax({
                url: '{{ route('getFeatures') }}',
                type: 'GET',
                dataType: 'json',
                data: { module_id: module_id },
                success: function(data) {
                    console.log('Features data:', data);
                    $featuresSelect.html(data);
                     $.each(data, function(index, value) {
                        $featuresSelect.append('<option value="'+value.id+'">'+value.name+'</option>');
                    });
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', xhr.responseText);
                }
            });
        }

        $(document).on('change', '#project_id', function() {
            var project_id = $(this).val();
            $('.module-select').each(function() {
                loadModules(project_id, $(this));
            });
        });

        $(document).on('change', '.module-select', function() {
            var module_id = $(this).val();
            var $featuresSelect = $(this).closest('.item-row').find('.features-select');
            loadFeatures(module_id, $featuresSelect);
        });

       // Add item button click
    $(document).on('click', '.add_item_btn', function(e) {
        e.preventDefault();
        var index = $('.item-row').length;
        var newRow = `<div class="row item-row">
            <div class="col-md-2 mb-3">
                <label class="form-label">Module</label>
                <select class="form-control module-select select2" name="project_module_id[]">
                    <option value="">Select</option>
                </select>
            </div>
            <div class="col-md-3 mb-3">
                <label class="form-label">Features</label>
                <select class="form-control features-select select2" name="features[` + index + `][]" multiple>
                    <option value="">Select</option>
                </select>
            </div>
            <div class="col-md-3 mb-3">
                <label class="form-label">Description</label>
                <textarea class="form-control" name="details[]"></textarea>
            </div>
            <div class="col-md-1 mb-3">
                <label class="form-label">Hours</label>
                <input class="form-control" type="text" name="hours[]">
            </div>
            <div class="col-md-2 mb-3">
                <label class="form-label">Employee</label>
                <select class="form-control select2" name="employee_id[` + index + `][]" multiple>
                    <option value="">Select</option>
                    @foreach($employee as $value)
                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-1 mt-4">
                <button class="btn btn-danger remove_item_btn">Remove</button>
            </div>
        </div>`;
        $(".show_transaction").append(newRow); // Append new rows at the end
        // Initialize Select2 for new selects
        $('.select2').select2();
        var project_id = $('#project_id').val();
        loadModules(project_id, $('.module-select').last());
    });

        // Remove item button click
        $(document).on('click', '.remove_item_btn', function(e) {
            e.preventDefault();
            $(this).closest('.item-row').remove();
        });
    });
</script>
@endpush
