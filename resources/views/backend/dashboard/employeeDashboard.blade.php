@extends('backend.partials.app')
@push('css')
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
<style>
    .bacground {
        background: beige;
    }

    .notice {
        text-align: center;
    }

    .notice h2 {
        background-color: #95ebcb;
        margin: 3px 0 !important;
        color: #fff;
    }

    .card-main {
        background-color: floralwhite;
        border-radius: 5% !important;
    }

    .swiper-container {
        width: 100%;
        height: 100%;
    }

    .swiper-slide {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100%;
    }

    .blocked-text {
        color: red;
        font-size: 30px;
        font-weight: bold;
        text-align: center;
        padding: 8px;
    }

    .animate-scale {
        animation: scaleAnimation 2s infinite;
        transition: 1s;
    }

    @keyframes scaleAnimation {

        0%,
        100% {
            transform: rotate(-15deg);
        }

        50% {
            transform: rotate(15deg);
        }
    }
</style>
@endpush

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 order-1">
            <div class="row justify-content-center mt-5 overflow-hidden">
                <div id="welcome" class="col-lg-4 col-md-4" style="height:200px;">

                </div>
                <div class="col-lg-3 col-md-3 col-6 mb-4">
                    <div class="card">
                        @php
                        use Carbon\Carbon;
                        $timeOnly = Carbon::parse($attendanceStart)->format('h:i:s A');
                        @endphp
                        @if($attendanceIN)
                        <div class="card-body" style="background: red;text-align:center;">
                            <a href="{{ route('end.attendance', $employeeId) }}" style="color: white; display: inline-block; width: 100%; text-align: center;font-size:25px;">End</a>
                        </div>

                        <span style="text-align:center;">Start Time: <strong>{{ $timeOnly}}</strong></span>
                        @elseif($attendanceEnd)

                        @elseif($blockCount)
                        <h2 class="blocked-text">You are blocked</h2>

                        @else
                        <div class="card-body" style="background: green;text-align:center;">
                            <a href="{{ route('get.attendance') }}" style="color: white; display: inline-block; width: 100%; text-align: center;font-size:25px;">Start</a>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="col-lg-5 col-md-5 col-6 mb-4">
                    <div class="card card-main">
                        <div class="card-body">
                            <div class="notice">
                                <h2>Notice</h2>
                                <div class="swiper-container overflow-hidden">
                                    <div class="swiper-wrapper">
                                        @foreach($currentNotices as $notice)
                                        <div class="swiper-slide">
                                            <h4><strong>{{ $notice->title }}</strong></h4>
                                            <p>{{ $notice->description }}</p>
                                        </div>
                                        @endforeach
                                    </div>
                                    <div class="swiper-pagination"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- // -->
            </div>

        </div>
        <!-- Total Revenue -->
    </div>
    <div class="row">
        <!-- project Task Data -->
        <div class="col-lg-12 col-md-12 col-xl-12 col-sm-12">
            <div class="table-responsive">
                <table class="table-striped table-bordered table-hover table">
                    <thead>
                        <tr>
                            <th>Project Title</th>
                            <th>Module Name</th>
                            <th>Features</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>dsgdf</td>
                            <td>dsgdf</td>
                            <td>dsgdf</td>
                            <td>dsgdf</td>
                            <td>dsgdf</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- / Content -->
@endsection
@push('js')
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const swiper = new Swiper('.swiper-container', {
            loop: true,
            slidesPerView: 1,
            spaceBetween: 10,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    });
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.7.6/lottie.min.js"></script>
<script>
    lottie.loadAnimation({
        container: document.getElementById('welcome'), // the DOM element
        renderer: 'svg',
        loop: true,
        autoplay: true,
        path: '/backend/assets/welcome.json' // the path to the animation json
    });
</script>

@endpush