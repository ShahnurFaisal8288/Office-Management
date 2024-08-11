@extends('backend.partials.app')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-lg-12 mb-4 order-0">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-12">
                        <div class="card-body">
                            <h5 class="card-title text-primary" style="text-transform: uppercase">Profile</h5>

                            <div class="row">
                                <!-- Basic Layout -->
                                <div class="col-xxl">
                                  <div class="card mb-4">

                                    <div class="card-body">
                                        @if (session('success'))
                                        <div class="alert slert-success timeout" style="color: green" >{{ session('success') }}</div>
                                        @elseif (session('error'))
                                        <div class="alert slert-danger timeout">{{ session('error') }}</div>

                                        @endif

                                      <form method="POST" enctype="multipart/form-data">
                                        @csrf
                                        
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label class="form-label" for="basic-default-name">Name</label>
                                                <input type="text" class="form-control" value="{{$auth->name}}" name="name" id="basic-default-name" placeholder="Enter Name" />
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label" for="basic-default-name">Email</label>
                                                <input type="text" class="form-control" value="{{$auth->email}}" name="email" id="basic-default-name" placeholder="Enter Email" />
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label class="form-label" for="basic-default-name">Course Image</label>
                                                <input type="file" class="form-control my-2" name="image" id="image"/>
                                                @if ($auth->image)
                                                  <img src="{{asset($auth->image)}}" alt="" style="width:200px;height:200px" class="image-style mb-3">
                                                @else
                                                <img style="width:200px;height:200px" id="showImage" src="{{ asset('backend/img/previewImage.png') }}" alt="" class="image-style mb-3">
                                                @endif
                                            </div>
                                        </div>

                                        <div class="row justify-content-end">
                                            <div class="col-md-6">
                                                <button type="submit" class="btn btn-primary">Send</button>
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
        </div>

    </div>

</div>
@endsection