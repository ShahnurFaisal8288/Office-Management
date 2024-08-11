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
                            <form method="post" enctype="multipart/form-data">
                                @csrf

                                <div class="row">

                                    <div class="col-xxl">
                                        <div class="card mb-2">
                                            <div class="card-body">
                                                @if (session('success'))
                                                <div class="alert slert-success timeout" style="color: green">{{ session('success') }}</div>
                                                @elseif (session('error'))
                                                <div class="alert slert-danger timeout">{{ session('error') }}</div>
                                                @endif

                                                <div style="text-align: center;">
                                                    <h2>New Purchase Order</h2>
                                                </div>
                                                <div class="row my-3 d-flex">
                                                    <div class="col-lg-3">
                                                        <label for="">From</label>
                                                        <textarea class="form-control" name="from" id="from">Icicle Corporation</textarea>
                                                       
                                                    </div>

                                                    <div class="col-lg-3">
                                                        <label for="to">To</label>
                                                        <textarea name="to" id="to" class="form-control"></textarea>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <label for="purchaseOrder_no">Purchase No</label>
                                                        <input type="text" value="{{ $serialNum }}" name="purchaseOrder_no" class="form-control">
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <label for="to">Email</label>
                                                        <input type="email" name="email" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="show_transaction">

                                                    <div class="row">

                                                        <div class="col-md-3 mb-3">

                                                            <label for="example-text-input" class="form-label">Service</label>
                                                            <select class="form-control" name="service_id[]" id="service_id">
                                                                <option value="">Select</option>
                                                                @foreach($service as $value)
                                                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-3 mb-3">
                                                            <label for="description" class="form-label">Description</label>
                                                            <textarea class="form-control description" name="description[]" id=""></textarea>
                                                        </div>
                                                        <div class="col-md-3 mb-3">
                                                            <label for="amount" class="form-label">Amount</label>
                                                            <input class="form-control amount" type="text" name="amount[]">
                                                        </div>
                                                        <div class="col-md-2 mt-4">
                                                            <button class="btn btn-success add_item_btn">Add More</button>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <label for="total">Total Amount</label>
                                                            <input type="text" name="total" id="total" class="form-control" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row my-3 d-flex">
                                                    <div class="col-lg-6">
                                                        <label for="terms_and_condition">Terms & Conditions</label>
                                                        <textarea name="terms_and_condition" id="terms_and_condition" class="form-control"></textarea>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <label for="signature">Signature</label>

                                                        <input type="file" name="signature" id="signature" class="form-control">
                                                        {{-- <img src="" alt=""> --}}
                                                    </div>
                                                </div><br>
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
                                                        <div class="col-md-3 mb-3">

                                                            <label for="example-text-input" class="form-label">Service</label>
                                                            <select class="form-control" name="service_id[]" id="service_id">
                                                                <option value="">Select</option>
                                                                @foreach($service as $value)
                                                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-3 mb-3">
                                                            <label for="description" class="form-label">Description</label>
                                                            <textarea class="form-control description" name="description[]" id=""></textarea>
                                                        </div>
                                                        
                                                        <div class="col-md-3 mb-3">

                                                            <label for="amount" class="form-label">Amount</label>
                                                            <input class="form-control amount" type="text" name="amount[]" id="amount">
                                                            <input class="form-control singleamount" type="hidden" name="singleamount[]">
                                                        </div>
                                                        <div class="col-md-2 mt-4">
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
<script>
    $(document).ready(function() {
        // Function to calculate total amount
        function calculateTotalAmount() {
            var totalAmount = 0;
            $('.amount').each(function() {
                totalAmount += parseFloat($(this).val()) || 0;
            });
            $('#total').val(totalAmount.toFixed(2));
            $('#due_amount').val(totalAmount.toFixed(2));
        }

        // Calculate total amount on page load
        calculateTotalAmount();

        //new
        $('body').on('keyup', '.amount', function() {
            calculateTotalAmount();
        });
        $('body').on('change', '.quantity', function() {
            var closestRow = $(this).closest('.row');
            var quantity = $(this).val();   
            var amount = closestRow.find('.amount').val();
            closestRow.find('.amount').val(quantity * amount);
            calculateTotalAmount();
        });
        $('body').on('change', '.service_id', function() {
            var service_id = $(this).val();
            var closestRow = $(this).closest('.row');
            console.log(service_id, closestRow);
            // Perform AJAX call to fetch price based on service_id (if needed)
        });
    });
    $(document).ready(function() {
        $('#advance, #due_amount').on('keyup', function() {
            var advance = parseFloat($('#advance').val()) || 0;
            var main_amount = parseFloat($('#total').val()) || 0;
            var dueAmount = main_amount - advance;
            $('#due_amount').val(dueAmount.toFixed(2));
        });
    });

</script>

@endpush
