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
                                            <form   method="post" enctype="multipart/form-data">
                                                @csrf

                                                <div class="row my-3">
                                                   <div style="text-align: center;">
                                                    <h2>New Application</h2>
                                                   </div>


                                                    <div class="col-md-8 mx-auto text-center">
                                                        <label for="application_type" class="my-2">Application Type</label>
                                                        <select name="application_type" id="application_type" class="form-control">
                                                            <option value="">Select</option>
                                                            <option value="Half Day Leave">Half Day Leave</option>
                                                            <option value="Full Day Leave">Full Day Leave</option>
                                                            <option value="2 Days Leave">2 Days Leave</option>
                                                            <option value="3 Days Leave">3 Days Leave</option>
                                                        </select>
                                                        <br>
                                                    </div>

                                                    <div class="col-md-8 mx-auto text-center">
                                                        <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject">
                                                        <br>
                                                    </div>
                                                    <div class="col-md-8 mx-auto text-center">
                                                        <label for="">From</label>
                                                        <input type="date" class="form-control" name="from_date" id="from_date">
                                                        <br>
                                                    </div>
                                                    <div class="col-md-8 mx-auto text-center">
                                                        <label for="">To</label>

                                                        <input type="date" class="form-control" name="to_date" id="to_date">
                                                        <br>
                                                    </div>
                                                    <div class="col-md-8 mx-auto text-center">
                                                        <textarea class="form-control" name="application_body" id="application_body" placeholder="Body"></textarea>
                                                        <br>
                                                    </div>
                                                    <div class="col-md-8 mx-auto text-center">
                                                        <input type="file" class="form-control" name="image" id="image">
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

