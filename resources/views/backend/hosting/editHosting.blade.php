@extends('backend.partials.app')

@push('css')
<style>
    .form-section {
        display: none;
    }

    .form-section.current {
        display: inherit;
    }

</style>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
{{-- --}}
@endpush
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-lg-12 mb-4 order-0">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-12">
                        <div class="card-body">
                            <h5 class="card-title text-primary" style="text-transform: uppercase">Edit Hosting</h5>
                            <div class="row">
                                <!-- Basic Layout -->
                                <div class="col-xxl">
                                    <div class="card mb-4">
                                        <div class="card-body">
                                            @if (session('success'))
                                            <div class="alert slert-success timeout" style="color: green">{{ session('success') }}</div>
                                            @elseif (session('error'))
                                            <div class="alert slert-danger timeout">{{ session('error') }}</div>
                                            @endif
                                            @include('error')


                                            <form class="form-demo" action="{{ route('hosting.update',$hosting->id) }}" method="POST">
                                                @method('PUT')
                                                @csrf
                                               
                                                <div class="form-group my-2">
                                                    <label for="hostingName">Hosting Name</label>
                                                    <input type="text" value="{{ $hosting->hostingName }}" class="form-control" name="hostingName" id="hostingName">
                                                </div>
                                                <div class="form-group my-2">
                                                    <label for="startDate">Start Date</label>
                                                    <input type="date" value="{{ $hosting->startDate }}" class="form-control" name="startDate" id="startDate">
                                                </div>
                                                <div class="form-group my-2">
                                                    <label for="endDate">End Date</label>
                                                    <input type="date" value="{{ $hosting->endDate }}" class="form-control" name="endDate" id="endDate">
                                                </div>
                                                <input type="submit" class="btn btn-success" value="Update">
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
