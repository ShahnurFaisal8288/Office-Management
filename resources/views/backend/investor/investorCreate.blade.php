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
                                            @if (session('success'))
                                            <div class="alert slert-success timeout" style="color: green">{{ session('success') }}</div>
                                            @elseif (session('error'))
                                            <div class="alert slert-danger timeout">{{ session('error') }}</div>
                                            @endif
                                            <form method="post" enctype="multipart/form-data">
                                                @csrf
                                                <div class="row my-3">
                                                    <div class="col-md-3">
                                                        <label for="name" class="my-2">Name</label>
                                                        <input type="text" name="name" id="name" class="form-control">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="project_name" class="my-2">Project Name</label>
                                                        <input type="text" name="project_name" id="project_name" class="form-control">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="agreed_amount" class="my-2">Agreed Amount</label>
                                                        <input type="text" name="agreed_amount" id="agreed_amount" class="form-control">
                                                    </div>

                                                    <div class="col-md-3">
                                                        <label for="strat_from" class="my-2">Start From</label>
                                                        <input type="text" name="start_from" id="strat_from" class="form-control ">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="strat_to" class="my-2">Start To</label>
                                                        <input type="text" name="start_to" id="strat_to" class="form-control ">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="total_inst" class="my-2">Total Installment</label>
                                                        <input type="text" name="total_inst" id="total_inst" class="form-control ">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="per_int_amount" class="my-2">Per Installment amount</label>
                                                        <input type="text" name="per_int_amount" id="per_int_amount" class="form-control ">
                                                    </div>

                                                    <div class="col-md-3">
                                                        <label class="form-label my-2" for="main_amount">Main Amount</label>
                                                        <input type="number" class="form-control" name="main_amount" id="main_amount" />
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="per_int_amount_word" class="my-2">Per Installment Amount(Word)</label>
                                                        <input type="text" name="per_int_amount_word" id="per_int_amount_word" class="form-control" placeholder="Enter Per Installment Amount(Word)Per Installment Amount(Word)">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="bank_name" class="my-2">Bank Name</label>
                                                        <input type="text" name="bank_name" id="bank_name" class="form-control" placeholder="Enter Bank Name">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="branch_name" class="my-2">Branch Name</label>
                                                        <input type="text" name="branch_name" id="branch_name" class="form-control" placeholder="Enter Branch Name">
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

