@extends('backend.partials.app')
@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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
                                            
                                            <form method="post" enctype="multipart/form-data" onsubmit="return checkAmount()">
                                                @csrf
                                                <div class="row my-2">
                                                    <div class="d-flex justify-content-between">
                                                        <div>
                                                            <h2>Update Expense</h2>
                                                        </div>
                                                        <div>
                                                            <a href="" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#exampleModal">Boost Cash In Hand</a>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="amount" class="my-2">Cash In Hand</label>
                                                        <input type="number" name="totalIncome" value="{{ $cashInHand }}" id="totalIncome" class="form-control" readonly><br>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div id="row">
                                                        <div class="input-group">
                                                            @foreach($expense->expenseDetails as $expenseDetail)
                                                            <div class="col-md-3">
                                                                <label for="category_id" class="my-2">Category</label>
                                                                <select name="category_id[]" class="form-control">
                                                                    <option value="">Select</option>
                                                                    @foreach($category as $item)
                                                                    <option value="{{ $item->id }}" {{ $expenseDetail->category_id == $item->id ? 'selected' : '' }}>{{ $item->category_name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-md-3 mx-2">
                                                                <label for="file" class="my-2">Attach Receipt</label>
                                                                <input type="file" name="file[]" class="form-control">
                                                            </div>
                                                            <div class="col-md-3 mx-2">
                                                                <label for="amount" class="my-2">Amount</label>
                                                                <input type="number" name="amount[]" value="{{ $expenseDetail->amount }}" class="inputAmount form-control"><br>
                                                            </div>
                                                            @endforeach
                                                            <div class="col-md-1 my-3">
                                                                <label for="add" class="my-2"></label>
                                                                <button id="rowAdder" type="button" class="btn btn-dark my-4">
                                                                    <span class="bi bi-plus-square-dotted"></span> ADD
                                                                </button>
                                                            </div>
                                                            <div class="col-md-1 my-3">
                                                                <label for="delete" class="my-2"></label>
                                                                <button class="btn btn-danger my-4 d-none" id="DeleteRow" type="button">
                                                                    <i class="bi bi-trash"></i> Delete
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="newinput"></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label for="name" class="my-2">Date</label>
                                                        <input type="date" name="date" id="date" class="form-control"><br>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="totalAmount" class="my-2">Total Amount</label>
                                                        <input type="number" name="totalAmount" value="{{$expense->totalAmount}}" id="totalAmount" class="form-control"><br>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="note" class="my-2">Note</label>
                                                        <textarea name="note" id="note" class="form-control">{{$expense->note}}</textarea><br>
                                                    </div>
                                                </div>
                                                <div class="text-center">
                                                    <input type="submit" value="Submit" class="btn btn-primary">
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
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Boost Cash In hand</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('cashInHand') }}" method="post">
                @csrf
                <div class="modal-body">
                    <input type="number" name="amount" id="amount" placeholder="Amount" class="form-control">
                </div>
                <div class="modal-body">
                    <textarea class="form-control" name="note" id="note" cols="" rows="" placeholder="note"></textarea>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    function checkAmount() {
        var cashInHand = parseFloat(document.getElementById('totalIncome').value);
        var amount = parseFloat(document.getElementById('amount').value);
        if (amount > cashInHand) {
            alert("Amount cannot be greater than Cash In Hand!");
            return false;
        }
        return true;
    }
</script>

<script type="text/javascript">
    $("#rowAdder").click(function() {
        var newRow = `
        <div class="input-group mb-3" id="row">
            <div class="col-md-3">
                <label for="category_id" class="my-2">Category</label>
                <select name="category_id[]" class="form-control">
                    <option value="">Select</option>
                    @foreach($category as $item)
                        <option value="{{ $item->id }}">{{ $item->category_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 mx-2">
                <label for="file" class="my-2">Attach Receipt</label>
                <input type="file" name="file[]" class="form-control">
            </div>
            <div class="col-md-3 mx-2">
                <label for="amount" class="my-2">Amount</label>
                <input type="number" name="amount[]" class="inputAmount form-control">
            </div>
            <div class="col-md-2 my-4">
                <button class="btn btn-danger" id="DeleteRow" type="button">
                    <i class="bi bi-trash"></i> Delete
                </button>
            </div>
        </div>`;
        $('#newinput').append(newRow);
        updateTotalAmount(); // Update total amount after adding a new row
    });

    $("body").on("click", "#DeleteRow", function() {
        $(this).closest("#row").remove();
        updateTotalAmount(); // Update total amount after removing a row
    });

    $(document).on('input', '.inputAmount', function() {
        updateTotalAmount(); // Update total amount when any inputAmount field changes
    });

    function updateTotalAmount() {
        var totalAmount = 0;
        $('.inputAmount').each(function() {
            var value = parseFloat($(this).val());
            if (!isNaN(value)) {
                totalAmount += value;
            }
        });
        $('#totalAmount').val(totalAmount);
    }
</script>

@endpush