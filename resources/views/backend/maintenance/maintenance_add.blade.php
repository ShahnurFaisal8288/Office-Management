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
                                                   <div style="text-align: center;">
                                                    <h2>Maintanence</h2>
                                                   </div>


                                                    <div class="col-md-8 mx-auto ">
                                                        <label for="customer_id" class="my-2">Customer</label>
                                                        <select class="form-control" name="customer_id" id="customer_id">
                                                            <option value="">Select</option>
                                                            @foreach ($customer as $item)
                                                            <option value="{{ $item->id }}">{{ $item->name_or_business }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-8 mx-auto ">
                                                        <label for="maintenance_amount" class="my-2">Maintenance Amount</label>
                                                        <input type="number" class="form-control" name="maintenance_amount" id="maintenance_amount">
                                                    </div>
                                                    <div class="col-md-8 mx-auto ">
                                                        <label for="maintenance_amount_inWord" class="my-2">Maintenance Amount (in Word)</label>
                                                        <input type="text" class="form-control" name="maintenance_amount_inWord" id="maintenance_amount_inWord">
                                                    </div>
                                                </div>
                                                <div class="text-center">
                                                    <input type="submit" value="Submit" class="btn btn-primary">
                                                </div>
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

