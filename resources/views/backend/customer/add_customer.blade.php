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
                                            <form action="{{ route('customer.store') }}" method="post" enctype="multipart/form-data">
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

