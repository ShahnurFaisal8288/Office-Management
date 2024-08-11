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
                            <form action="{{ route('transaction.store') }}" method="post" enctype="multipart/form-data">
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
                                                    <h2>New Transaction</h2>
                                                </div>
                                                <div class="row my-3 d-flex">
                                                    <div class="add-btn m-3">
                                                        <a class="btn btn-info" style="color: floralwhite" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fas fa-plus"></i>Add Customer</a>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <label for="">Customer</label>
                                                        <select class="form-control" name="customer_id">

                                                            <option value="">Select Customer</option>
                                                            @foreach ($customer as $value)
                                                            <option value="{{ $value->id }}">{{ $value->name_or_business }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <label for="po_so_number">P.O/S.O Number</label>
                                                        <input type="text" name="po_so_number" id="po_so_number" class="form-control" placeholder="Enter P.O/S.O Number">
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <label for="transaction_date">Transaction Date</label>
                                                        <input type="date" name="transaction_date" id="transaction_date" class="form-control">
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <label for="payment_due_date">Payment Due Date</label>
                                                        <input type="date" name="payment_due_date" id="payment_due_date" class="form-control">
                                                    </div><br>
                                                </div>
                                                <hr>

                                                <hr>

                                                <div class="show_transaction">
                                                    <div class="row">
                                                        <div class="col-md-3 mb-3">

                                                            <label for="example-text-input" class="form-label">Service & Product Name </label>
                                                            <select class="form-control service_id" name="service_id[]">

                                                                <option value="">Select Service & Product</option>
                                                                @foreach ($service as $value)
                                                                <option value="{{ $value->id }}">{{ $value->name }}</option>
                                                                @endforeach
                                                            </select>

                                                        </div>
                                                        <div class="col-md-3 mb-3">
                                                            <label for="quantity" class="form-label">Quantity</label>
                                                            <input class="form-control quantity" type="number" name="quantity[]" value="1" placeholder="Enter Quantity">
                                                        </div>
                                                        <div class="col-md-3 mb-3">

                                                            <label for="amount" class="form-label">Amount</label>
                                                            <input class="form-control amount" type="text" name="amount[]">
                                                            <input class="form-control singleamount" type="hidden" name="singleamount[]">

                                                        </div>
                                                        <div class="col-md-2 mt-4">
                                                            <button class="btn btn-success add_item_btn">Add More</button>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <label for="total_amount">Total Amount</label>
                                                            <input type="text" name="total_amount" id="total_amount" class="form-control" readonly>
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

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('customer.transaction') }}" method="post" enctype="multipart/form-data">
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
          <button type="button" class="btn btn-primary">Save changes</button>
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

                                                            <label for="example-text-input" class="form-label">Service & Product Name </label>
                                                            <select class="form-control service_id" name="service_id[]" >

                                                                <option value="">Select Service & Product</option>
                                                                @foreach ($service as $value)
                                                                <option id="customer_id" value="{{ $value->id }}">{{ $value->name }}</option>
                                                                @endforeach
                                                            </select>

                                                        </div>
                                                        <div class="col-md-3 mb-3">

                                                            <label for="quantity" class="form-label quantity">Quantity</label>
                                                            <input class="form-control quantity" type="number" name="quantity[]" id="quantity" value="1" placeholder="Enter Quantity">
                                                           

                                                        </div>
                                                        <div class="col-md-3 mb-3">

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

        // Function to calculate total amount
        function calculateTotalAmount() {
            var totalAmount = 0;
            $('.amount').each(function() {
                totalAmount += parseFloat($(this).val()) || 0;
            });
            $('#total_amount').val(totalAmount.toFixed(2));
        }

        // Calculate total amount on page load
        calculateTotalAmount();

        $('body').on('change', '.service_id', function() {
            var service_id = $(this).val();
            var closestRow = $(this).closest('.row');
            $.ajax({
                url: '/getPrice'
                , type: 'post'
                , dataType: 'json'
                , data: 'service_id=' + service_id
                , headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                , success: function(data) {
                    closestRow.find('.singleamount').val(data[0].price);
                    closestRow.find('.amount').val(data[0].price);
                    // Recalculate total amount when price changes
                    calculateTotalAmount();
                }
                , error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });

        $('body').on('keyup', '.quantity', function() {
            var closestRow = $(this).closest('.row');0
            var quantity = $(this).val();
            var amount = closestRow.find('.singleamount').val();
            closestRow.find('.amount').val(quantity * amount);
            // Recalculate total amount when quantity changes
            calculateTotalAmount();
        });



        $('body').on('change', '.service_id', function() {
            var service_id = $(this).val();
            var closestRow = $(this).closest('.row');
            console.log(service_id, closestRow);
            $.ajax({
                url: '/getPrice'
                , type: 'post'
                , dataType: 'json'
                , data: 'service_id=' + service_id
                , headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                , success: function(data) {
                    // Assuming $service contains the price
                    // $('.amount').val(data[0].price);
                    closestRow.find('.singleamount').val(data[0].price);

                    closestRow.find('.amount').val(data[0].price);
                }
                , error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });


        $('body').on('change', '.quantity', function() {
            var closestRow = $(this).closest('.row');

            var quantity = $(this).val();
            var amount = closestRow.find('.singleamount').val();
            closestRow.find('.amount').val(quantity * amount);
        });


    });

</script>

@endpush
