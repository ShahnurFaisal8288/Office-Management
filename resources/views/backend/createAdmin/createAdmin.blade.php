@extends('backend.partials.app')
@section('title')
Add Module
@endsection
@section('content')
<div class="container customer-container">
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-3">
                <div class="card-header mx-5 my-3 customer-card">
                    <div class="left">
                        <h3>Admin Create</h3>
                    </div>
                    <div class="search">
                        <a href="{{ route('adminList') }}" class="btn btn-primary" title="Admin List">
                            <i class="fas fa-list"></i> Admin List
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('error')

    <div class="card">
        <div class="card-body">
            <form action="{{ route('adminCreate') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="form-group col-lg-6">
                        <label for="name"><strong>Name</strong></label>
                        <input type="text" id="name" name="name" placeholder="Admin Name" class="form-control my-2">
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="email"><strong>Email</strong></label>
                        <input type="text" id="email" name="email" placeholder="Admin Email" class="form-control my-2">
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="phone"><strong>Mobile</strong></label>
                        <input type="text" id="phone" name="phone" placeholder="Admin Mobile Number" class="form-control my-2">
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="password"><strong>Password</strong></label>
                        <input type="password" id="password" name="password" placeholder="Admin Password" class="form-control my-2">
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="roles">Choose a Role:</label>
                        <select id="roles" name="user_role" class="form-control">
                            @foreach($adminCreate as $role)
                            <option value="{{ $role->id }}">{{ $role->role_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    {{-- <div class="form-group col-lg-6">
                        <label for="emergency_phone">Emergency Phone</label>
                        <input class="form-control" type="text" name="emergency_phone" id="emergency_phone">
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="relationToEmergency">Relation To Emergency</label>
                        <input class="form-control" type="text" name="relationToEmergency" id="relationToEmergency">
                    </div> --}}
                    {{-- <div class="form-group col-lg-6">
                        <label for="address">Address</label>
                        <input class="form-control" type="text" name="address" id="address">
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="blood_group">Blood Group</label>
                        <input class="form-control" type="text" name="blood_group" id="blood_group">
                    </div> --}}
                    {{-- <div class="form-group col-lg-6">
                        <label for="nid">Nid</label>
                        <input class="form-control" type="file" name="nid" id="nid">
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="image">Image</label>
                        <input class="form-control" type="file" name="image" id="image">
                    </div> --}}
                    <div class="form-group col-lg-6">
                        <label for="designation">Designation</label>
                        <input class="form-control" type="text" name="designation" id="designation">
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="profession_type">Designation Type</label>
                        <select class="form-control" name="profession_type" id="profession_type">
                            <option value="">Select Profession Type</option>
                            <option value="intern">Intern/Probation</option>
                            <option value="permanent">Permanent</option>
                        </select>
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="intern_duration">Intern/Probation Duration</label>
                        <select class="form-control" name="intern_duration" id="intern_duration">
                            <option value="">Select Duration</option>
                            <option value="3_months">3 Months</option>
                        </select>
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="joining_date">Joining Date</label>
                        <input class="form-control" type="date" name="joining_date" id="joining_date">
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="pay_agreement">Pay agreement</label>
                        <input class="form-control" type="number" name="pay_agreement" id="pay_agreement">
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="last_increment_date">Last Increment Date (optional)</label>
                        <input class="form-control" type="date" name="last_increment_date" id="last_increment_date">
                    </div>
                </div>
                <input type="submit" value="Submit" class="btn btn-primary my-3">
            </form>
        </div>
    </div>
</div>
@endsection