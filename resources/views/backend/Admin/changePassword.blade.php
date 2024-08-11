@extends('backend.partials.app')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-lg-12 mb-4 order-0">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-12">
                        <div class="card-body">
                            <h5 class="card-title text-primary" style="text-transform: uppercase">Change Password</h5>

                            <div class="row">
                                <!-- Basic Layout -->
                                <div class="col-xxl">
                                  <div class="card mb-4">
                                    @include('error')
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
                                                <label class="form-label" for="basic-default-name">Old Password</label>
                                                <input type="password" class="form-control"  name="oldPassword" id="basic-default-name" placeholder="Enter Old Password" />
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label" for="basic-default-name">New Password</label>
                                                <input type="password" class="form-control"  name="newPassword" id="basic-default-name" placeholder="Enter New Password" />
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label" for="basic-default-name">Confirm Password</label>
                                                <input type="password" class="form-control"  name="confirmPassword" id="basic-default-name" placeholder="Enter Confirm Password" />
                                            </div>

                                        </div>
                                    
                                        <div class="row justify-content-end">
                                            <div class="col-md-6">
                                                <button type="submit" class="btn btn-primary">Submit</button>
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