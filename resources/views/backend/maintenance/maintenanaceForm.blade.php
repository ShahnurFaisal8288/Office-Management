@extends('backend.partials.app')
@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    h3,
    h1,
    h2,
    h5,
    h6,
    p,
    td,
    th,
    table,
    tr span {
        color: black
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
                            <div class="row">
                                <!-- Basic Layout -->
                                <div class="col-xxl">
                                    <div class="card mb-2">
                                        <div class="card-body">
                                            @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            @endif
                                            <form method="post" enctype="multipart/form-data">
                                                @csrf
                                                <div class="row my-3">
                                                    <div class="col-md-3">
                                                        <label for="serial_No" class="my-2">Client</label>
                                                        <select name="maintenance_id" id="serial_No" class="form-control my-2">
                                                            <option value="">Select Serial ID</option>
                                                            @foreach ($maintenance as $value)
                                                            <option value="{{ $value->id }}">{{ $value->customer->name_or_business }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="name" class="my-2">Name</label>
                                                        <input type="text" name="name" id="name" class="form-control">
                                                    </div>
                                                    <div class="col-md-3 mb-4">
                                                        <label class="form-label my-2" for="allow_amount">maintenance_amount</label>
                                                        <input class="form-control" name="maintenance_amount" id="maintenance_amount">

                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="form-label my-2" for="main_amount">maintenance_amount_inWord</label>
                                                        <input type="text" class="form-control" name="maintenance_amount_inWord" id="maintenance_amount_inWord" />
                                                    </div><br>
                                                    <div class="col-md-3">
                                                        <label for="bank_name" class="my-2">Bank Name</label>
                                                        <input type="text" name="bank_name" id="bank_name" class="form-control">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="branch_name" class="my-2">Branch Name</label>
                                                        <input type="text" name="branch_name" id="branch_name" class="form-control">
                                                    </div>


                                                    <div class="col-md-3">
                                                        <label class="form-label my-2" for="payment_type2">Payment Type</label>
                                                        <select class="form-control" name="payment_type" id="payment_type">
                                                            <option value="">Select Payment Type</option>
                                                            <option value="cash">Cash</option>
                                                            <option value="chq">CHQ</option>
                                                            <option value="Online Payment">Online Payment ( Bank to Bank)</option>

                                                        </select>
                                                    </div>

                                                </div>
                                                <hr>
                                                <div class="row my-3">

                                                    <div class="table-responsive">
                                                        <table class="table table-stipe table-bordered table-hover">
                                                            <thead>
                                                                <tr>
                                                                    {{-- <th><strong>Fee Name</strong></th>
                                                                    <th><strong>Month From</strong></th>
                                                                    <th><strong>Month To</strong></th> --}}
                                                                    <th><strong>Amount</strong></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="paymentTable">
                                                                <tr>
                                                                    {{-- <td>Monthly Pay</td>
                                                                    <td>
                                                                        <input type="month" class="form-control" name="start_month" id="start_month" readonly>
                                                                    </td>
                                                                    <td>
                                                                        <input type="month" class="form-control" name="end_month" id="end_month">
                                                                    </td> --}}
                                                                    <td>
                                                                        <input type="text" class="form-control" name="amount" id="amount">
                                                                    </td>

                                                                </tr>
                                                            </tbody>

                                                        </table>
                                                    </div>
                                                </div>
                                                <input type="submit" value="Submit" class="btn btn-primary">
                                                <hr>
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
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#image').change('click', function(e) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });

</script>
<script>
    setTimeout(() => {
        $('.timeout').fadeOut('slow')
    }, 3000);

</script>
<script>
    $(document).ready(function() {
        $('#serial_No').select2();
    });

</script>
{{-- ajax pay --}}
<script>
    $(document).ready(function() {
        $('#serial_No').change(function() {
            var serialNo = $(this).val();
            $.ajax({
                url: '/getMaintenanceAmount'
                , type: 'GET'
                , data: {
                    serial_No: serialNo
                }
                , success: function(response) {
                    // Populate form fields with received data
                    $('#name').val(response.customer.name_or_business);
                    $('#maintenance_amount').val(response.maintenance_amount);
                    $('#maintenance_amount_inWord').val(response.maintenance_amount_inWord);
                }
                , error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
    });

</script>

@endpush
