@extends('backend.partials.app')
@section('content')
@push('css')
<style>
   
</style>
@endpush
<div class="container">
    <div class="row">
        <div class="col-md-12 col-lg-12 col-xl-12 col-sm-12">
            <div class="card">
                <div class="card-body">
                <form action="{{route('store.pad')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12 m-auto">
                       @include('error')
                        <div class="card shadow">
                            <div class="card-header">
                                <h4 class="card-title"> Create Post </h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label> Title </label>
                                    <input type="text" class="form-control" name="title" placeholder="Enter the Title">
                                </div>
                                <div class="form-group">
                                    <label>Pad Body </label>
                                    <textarea class="form-control" id="content" placeholder="Enter the Description" rows="5" name="padBody"></textarea>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success"> Save </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
      <script src="https://cdn.ckeditor.com/ckeditor5/23.0.0/classic/ckeditor.js"></script>
      <script>
            ClassicEditor.create( document.querySelector( '#content' ) )
                .catch( error => {
                    console.error( error );
                } );
        </script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
@endpush
