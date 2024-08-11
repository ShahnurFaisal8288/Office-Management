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

