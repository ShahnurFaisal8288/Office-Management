@extends('backend.partials.app')

@push('css')
<style>
.form-section {
    display: none;
}

.form-section.current {
    display: inherit;
}
</style>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
{{-- --}}
@endpush
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-lg-12 mb-4 order-0">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-12">
                        <div class="card-body">
                            <h5 class="card-title text-primary" style="text-transform: uppercase">Edit Task</h5>
                            <div class="row">
                                <!-- Basic Layout -->
                                <div class="col-xxl">
                                    <div class="card mb-4">
                                        <div class="card-body">
                                            @if (session('success'))
                                            <div class="alert slert-success timeout" style="color: green">
                                                {{ session('success') }}</div>
                                            @elseif (session('error'))
                                            <div class="alert slert-danger timeout">{{ session('error') }}</div>
                                            @endif
                                            @include('error')


                                            <form class="form-demo" action="{{ route('task.update',$task->id) }}"
                                                method="POST">
                                                @method('PUT')
                                                @csrf
                                                <div class="form-group my-2">
                                                    <label for="">Employee</label>
                                                    <select class="form-control" name="customer_id" id="customer_id">
                                                        <option value="">Choose Project/Client</option>
                                                        @foreach($customer as $value)
                                                        <option value="{{ $value->id }}"
                                                            {{ $value->id == $task->customer_id ? 'selected' : '' }}>
                                                            {{ $value->name_or_business }}
                                                        </option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                                <div class="form-group my-2">
                                                    <label for="">Employee</label>
                                                    <select class="form-control" name="employee_id" id="employee_id">
                                                        <option value="">Choose Employee</option>
                                                        @foreach($employee as $value)
                                                        <option value="{{ $value->authId }}"
                                                            {{ $value->authId == $task->employee_id ? 'selected' : '' }}>
                                                            {{ $value->name }}</option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                                <!-- <div class="table-responsive">
                                                    <table class="table table-bordered" id="articles">
                                                        <label for="title">Title</label>
                                                        <tr>
                                                            <td><input type="text" id="" name="title[]" placeholder="Title" class="form-control name_list" /></td>
                                                            <td><button type="button" name="add" id="add"
                                                                    class="btn btn-success">Add new</button>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div> -->
                                                <!-- <div class="table-responsive mt-2">
                                                    <table class="table table-bordered" id="articles">
                                                        <thead>
                                                            <tr>
                                                                <th>Task</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($task->taskDetails as $taskDetail)
                                                            <tr>
                                                                <td><input type="text" name="titles[]"
                                                                        value="{{ $taskDetail->title }}"
                                                                        class="form-control name_list" /></td>
                                                                <td><button type="button" name="remove"
                                                                        class="btn btn-danger btn_remove">Remove</button>
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                    <button type="button" name="add" id="add"
                                                        class="btn btn-success mt-2">Add new</button>
                                                </div> -->





                                                <div class="form-group my-2">
                                                    <label for="description">Description</label>
                                                    <textarea class="form-control" name="description" id="description"
                                                        cols="30" rows="10">{{ $task->description }}</textarea>
                                                </div>
                                                <div class="form-group my-2">
                                                    <label for="assign_date">Assign Date</label>
                                                    <input type="date" class="form-control"
                                                        value="{{ $task->assign_date }}" name="assign_date"
                                                        id="assign_date">
                                                </div>
                                                <div class="form-group my-2">
                                                    <label for="end_date">End Date</label>
                                                    <input type="date" class="form-control"
                                                        value="{{ $task->end_date }}" name="end_date" id="end_date">
                                                </div>
                                                <div class="form-group my-2">
                                                    <label for="status">Status</label>
                                                    <select class="form-control" name="status" id="status">
                                                        <option value="">Choose Status</option>
                                                        <option value="active"
                                                            {{ $task->status == 'active' ? 'selected' : '' }}>Active
                                                        </option>
                                                        <option value="inactive"
                                                            {{ $task->status == 'inactive' ? 'selected' : '' }}>Inactive
                                                        </option>
                                                    </select>
                                                </div>
                                                <input type="submit" class="btn btn-success" value="submit">
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
</div>

</div>

</div>
@endsection
@push('js')

<script>
$(document).ready(function() {
    var i = 1;
    $('#add').click(function() {
        i++;
        $('#articles').append('<tr id="row' + i +
            '"><td><input type="text" id="quantity" name="title[]" placeholder="Task" class="form-control name_list" /></td><td><button type="button" name="remove" id="' +
            i + '" class="btn btn-danger btn_remove">X</button></td></tr>');
    });

    $(document).on('click', '.btn_remove', function() {
        var button_id = $(this).attr("id");
        $('#row' + button_id + '').remove();
    });

    $('#submit').click(function() {
        //alert($('#add_name').serialize()); //alerts all values and works fine          
        $.ajax({
            url: "wwwdb.php",
            method: "POST",
            data: $('#add_name').serialize(),
            success: function(data) {
                $('#add_name')[0].reset();
            }
        });
    });

    function upd_art() {
        var qty = $('#quantity').val();
        var price = $('#price').val();
        var total = (qty * price).toFixed(2);
        $('#total').val(total);
    }
    setInterval(upd_art, 1000);
});












$(document).ready(function() {
    // Check if $taskDetail->titles exists and is not null
    var titlesCount = {{ $taskDetail->titles ? $taskDetail->titles->count() : 0 }};
    var i = titlesCount;

    $('#add').click(function() {
        i++;
        $('#articles tbody').append('<tr id="row' + i + '"><td><input type="text" name="titles[]" class="form-control name_list" /></td><td><button type="button" name="remove" class="btn btn-danger btn_remove">Remove</button></td></tr>');
    });

    $(document).on('click', '.btn_remove', function() {
        $(this).closest('tr').remove();
        // Optionally, you can re-index the remaining rows if needed
        // Re-indexRows();
    });
});

</script>
@endpush