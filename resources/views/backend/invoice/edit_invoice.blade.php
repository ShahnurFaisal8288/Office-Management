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
                            <form action="{{ route('invoice.update',$invoices->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
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
                                                    <h2>New Invoice</h2>
                                                </div>
                                                <div class="row my-3 d-flex">
                                                    <div class="col-lg-12">
                                                        <div class="add-btn m-3" style="display:inline-block;">
                                                            <a class="btn btn-info" style="color: floralwhite" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fas fa-plus"></i>Customer</a>
                                                        </div>
                                                        <div class="add-btn m-3" style="display:inline-block;">
                                                            <a class="btn btn-info" style="color: floralwhite" data-bs-toggle="modal" data-bs-target="#exampleModal2"><i class="fas fa-plus"></i>Service</a>
                                                        </div>

                                                    </div>
                                                    <div class="col-lg-6">
                                                        <label for="">Customer</label>
                                                        <select class="form-control" name="customer_id" id="customer_id">

                                                            <option value="">Select Customer</option>
                                                            @foreach ($customer as $value)
                                                            <option value="{{ $value->id }}" {{$invoices->customer_id == $value->id ? 'selected' : '' }}>{{ $value->name_or_business }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    {{-- <div class="col-lg-6">
                                                        <label for="payment_type">Payment Method</label>
                                                        <select type="text" name="payment_type" id="payment_type" class="form-control">
                                                            <option value="cash">Cash</option>
                                                            <option value="chq">CHQ</option>
                                                            <option value="online">Online</option>
                                                        </select>

                                                    </div> --}}
                                                    <div class="col-lg-6">
                                                        <label for="po_so_number">P.O/S.O Number</label>
                                                        <input type="text" name="po_so_number" value="{{ $value->po_so_number }}" id="po_so_number" class="form-control" placeholder="Enter P.O/S.O Number">
                                                    </div>
                                                    {{-- <div class="col-lg-6">
                                                        <label for="transaction_date">Invoice Date</label>
                                                        <input type="date" name="transaction_date" id="transaction_date" class="form-control">
                                                    </div> --}}


                                                </div>
                                                <div class="show_transaction">

                                                    @foreach($invoices->services as $invoiceService)
                                                    <div class="row">
                                                        <div class="col-md-2 mb-3">
                                                            <label for="example-text-input" class="form-label">Service & Product Name </label>
                                                            <select class="form-control service_id" name="service_id[]">
                                                                <option value="">Select Service & Product</option>
                                                                @foreach ($service as $value)
                                                                <option value="{{ $value->id }}" {{ $invoiceService->id == $value->id ? 'selected' : '' }}>{{ $value->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-3 mb-3">
                                                            <label for="description" class="form-label">Description</label>
                                                            <textarea class="form-control quantity" name="description[]">{{ $invoiceService->pivot->description }}</textarea>
                                                        </div>
                                                        <div class="col-md-2 mb-3">
                                                            <label for="quantity" class="form-label">Quantity</label>
                                                            <input class="form-control quantity" type="number" name="quantity[]" value="{{ $invoiceService->pivot->quantity }}" placeholder="Enter Quantity">
                                                        </div>
                                                        <div class="col-md-2 mb-3">
                                                            <label for="amount" class="form-label">Amount</label>
                                                            <input class="form-control amount" type="text" name="amount[]" value="{{ $invoiceService->pivot->amount }}" readonly>
                                                            <input class="form-control singleamount" type="hidden" name="singleamount[]" >
                                                        </div>
                                                        <div class="col-md-2 mt-4">
                                                            <button class="btn btn-danger remove_item_btn">Remove</button>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </div>
                                               <div class="row">
                                                <div class="col-lg-4">
                                                    <label for="total_amount">Sub Total Amount</label>
                                                    <input type="text" name="total_amount" id="total_amount" class="form-control" readonly>
                                                </div>
                                                <div class="col-lg-4">
                                                    <label for="discount">Discount Amount</label>
                                                    <input type="number" name="discount" id="discount" class="form-control">
                                                </div>
                                                <div class="col-lg-4">
                                                    <label for="disWith_total_amount">Total Amount</label>
                                                    <input type="text" name="disWith_total_amount" id="disWith_total_amount" class="form-control" readonly>
                                                </div>
                                               </div>
                                                <div class="row my-3 d-flex">
                                                    <div class="col-lg-6">
                                                        <label for="advance">Pay Amount</label>
                                                        <input type="text" name="advance" id="advance" class="form-control">
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <label for="main_amount">Due Amount</label>
                                                        <input type="text" value="{{ $invoices->dueAmount }}" name="dueAmount" id="due_amount" class="form-control">
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <label for="invoice_date">Invoice Date</label>
                                                        <input type="date" name="invoice_date" id="invoice_date" value="{{ $invoices->invoice_date }}" class="form-control">
                                                    </div>
                                                    <div class="col-lg-6 mb-3">
                                                        <label for="payment_due_date">Next Payment Date</label>
                                                        <input type="date" name="payment_due_date" id="payment_due_date" value="{{ $invoices->payment_due_date }}" class="form-control">
                                                    </div>
                                                    <hr>
                                                    <hr>
                                                    <div class="col-lg-6">
                                                        <label for="paid">Paid</label>
                                                        <input type="text" name="paid" value="{{ $invoices->advance }}" class="form-control" readonly>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <label for="paid">Due</label>
                                                        <input type="text" name="due" value="{{ $invoices->dueAmount }}" class="form-control" readonly>
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

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('customer.invoice') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="row my-3">
                        <div style="text-align: center;">
                            <h2>New Customer</h2>
                        </div>


                        <div class="col-md-8 mx-auto text-center">
                            <label for="name_or_business" class="my-2">Customer</label>
                            <input type="text" name="name_or_business" id="name_or_business" class="form-control" placeholder="Name of a business or person">
                        </div>
                        <div class="col-md-8 mx-auto text-center">
                            <label for="name" class="my-2">Primary Contact</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Enter Persons's Name"><br>
                        </div>
                        <div class="col-md-8 mx-auto">
                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter Email"><br>
                        </div>
                        <div class="col-md-8 mx-auto">

                            <input type="text" name="phone" id="phone" class="form-control" placeholder="Enter Phone"><br>
                        </div>

                        <div class="col-md-8 mx-auto">

                            <input type="text" name="address" id="address" class="form-control" placeholder="Enter Address">
                        </div>


                    </div>
                    <div class="text-center">
                        <input type="submit" value="Submit" class="btn btn-primary">
                    </div>
                    <hr>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>
</div>
{{-- modal2 --}}
<!-- Modal -->
<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('service.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row my-3">
                        <div style="text-align: center;">
                            <h2>New Product & Service</h2>
                        </div>


                        <div class="col-md-8 mx-auto ">
                            <label for="name" class="my-2">Name</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Enter Name">
                        </div>
                        <div class="col-md-8 mx-auto ">
                            <label for="description" class="my-2">Description</label>
                            <textarea class="form-control" name="description" id="description" cols="30" rows="10"></textarea>
                        </div>
                        {{-- <div class="col-md-8 mx-auto ">
                            <label for="price" class="my-2">Price</label>
                            <input type="text" name="price" id="price" class="form-control" placeholder="Enter Price">
                        </div> --}}



                    </div>
                    <div class="text-center">
                        <input type="submit" value="Submit" class="btn btn-primary">
                    </div>
                    <hr>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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

                                                            <label for="example-text-input" class="form-label">Service & Product Name </label>
                                                            <select class="form-control service_id" name="service_id[]" >

                                                                <option value="">Select Service & Product</option>
                                                                @foreach ($service as $value)
                                                                <option id="customer_id" value="{{ $value->id }}">{{ $value->name }}</option>
                                                                @endforeach
                                                            </select>

                                                        </div>
                                                        <div class="col-md-3 mb-3">
                                                            <label for="description" class="form-label">Description</label>
                                                            <textarea class="form-control quantity" name="description[]"></textarea>
                                                        </div>
                                                        <div class="col-md-2 mb-3">

                                                            <label for="quantity" class="form-label quantity">Quantity</label>
                                                            <input class="form-control quantity" type="number" name="quantity[]" id="quantity" value="1" placeholder="Enter Quantity">

                                                        </div>
                                                        <div class="col-md-2 mb-3">

                                                            <label for="quantity" class="form-label">Amount</label>
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
        function calculateTotalAmount() {
            var totalAmount = 0;
            $('.amount').each(function() {
                totalAmount += parseFloat($(this).val());
            });
            $('#total_amount').val(totalAmount.toFixed(2));
            $('#disWith_total_amount').val(totalAmount.toFixed(2));
            $('#due_amount').val(totalAmount.toFixed(2));
        }
        
        // Calculate total amount on page load
        calculateTotalAmount();

        //new
        $('body').on('keyup', '.amount', function() {
            calculateTotalAmount();
        });
        // Function to calculate total amount
        function calculateTotalAmount() {
            var totalAmount = 0;
            $('.amount').each(function() {
                totalAmount += parseFloat($(this).val());
            });
            $('#total_amount').val(totalAmount.toFixed(2));
            $('#disWith_total_amount').val(totalAmount.toFixed(2));
            // $('#due_amount').val(totalAmount.toFixed(2));
        }

        // Calculate total amount on page load
        calculateTotalAmount();

        //new
        $('body').on('keyup', '.amount', function() {
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
        $('#advance, #due_amount,#discount').on('keyup', function() {
            var advance = parseFloat($('#advance').val()) || 0;
            var discount = parseFloat($('#discount').val()) || 0;
            var main_amount = parseFloat($('#total_amount').val()) || 0;
            var discountAmount = main_amount - discount;
            // var dueAmount = main_amount - (advance + discount);
            $('#disWith_total_amount').val(discountAmount.toFixed(2));
            // $('#due_amount').val(dueAmount.toFixed(2));
        });
    });

    //ajax Due
    $(document).ready(function() {
        $('#customer_id').change(function() {
            var customer_id = $(this).val();
            $.ajax({
                url: '/getDue'
                , type: 'get'
                , dataType: 'json'
                , data: {
                    customer_id: customer_id
                }
                , success: function(data) {
                    $('#paid').val(data.paid); // Update the paid amount input field
                    $('#due').val(data.due); // Update the due amount input field
                }
                , error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });

</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Get the advance and due amount fields
    const advanceField = document.getElementById('advance');
    const dueAmountField = document.getElementById('due_amount');
    
    // Get the initial due amount from the field's value attribute
    const initialDueAmount = parseFloat(dueAmountField.getAttribute('value')) || 0;

    // Function to update the due amount
    function updateDueAmount() {
        // Get the entered advance amount
        const newAdvance = parseFloat(advanceField.value) || 0;
        
        // Calculate the new due amount
        const newDueAmount = initialDueAmount - newAdvance;
        
        // Update the due amount field
        dueAmountField.value = newDueAmount.toFixed(2);
    }

    // Add an event listener to the advance field
    advanceField.addEventListener('input', updateDueAmount);
});
// $('#customer_id').change(function () {
//     var customer_id = $(this).val();
//     $.ajax({
//         url: '/getDue',
//         type: 'get',
//         dataType: 'json',
//         data: { customer_id: customer_id },
//         success: function (data) {
//             $('#paid').val(data.paid); // Update the paid amount input field
//             $('#due').val(data.due);   // Update the due amount input field
//         },
//         error: function (xhr, status, error) {
//             console.error(xhr.responseText);
//         }
//     });
// });

</script>


@endpush
