@extends('backend.partials.app')
@push('css')
<style>
    .bacground {
        background: beige;

    }

</style>
@endpush
@section('content')
<div class="container-xxl flex-grow-1 container-p-y ">
    <div class="row">

        <div class="col-lg-12 col-md-12 col-sm-12 order-1">
            <div class="row">


                <div class="col-lg-3 col-md-3 col-6 mb-4">
                    <div class="card">
                        <div class="card-body" style="background: rgb(177, 1, 1)">
                            <a href="{{ route('customerList') }}">
                                <span style="color: white">Total Client</span>
                                <h3 style="color: white" class="card-title text-nowrap mb-1">{{ $customer }} Person</h3>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-6 mb-4">
                    <div class="card">
                        <div class="card-body" style="background: rgb(212, 88, 4)">
                            <a href="{{ route('receivableCurrent') }}">
                                <span style="color: white">Receivable In <strong>{{ $currentMonthName }}</strong></span>
                                <h3 style="color: white" class="card-title text-nowrap mb-1">{{ $receivableCurrent }} Tk.</h3>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-6 mb-4">
                    <div class="card">
                        <div class="card-body" style="background: rgb(175, 138, 14)">
                            <a href="{{ route('currentIncomeList') }}">
                                <span style="color: white">Income In <strong>{{ $currentMonthName }}</strong></span>
                                <h3 style="color: white" class="card-title text-nowrap mb-1">{{ $incomeCurrent }} Tk.</h3>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-6 mb-4">
                    <div class="card">
                        <div class="card-body" style="background: rgb(175, 138, 14)">
                            <a href="{{ route('currentIncomeList') }}">
                                <span style="color: white">Unpaid In <strong>{{ $currentMonthName }}</strong></span>
                                <h3 style="color: white" class="card-title text-nowrap mb-1">{{ $unpaidAmountCurrent }} Tk.</h3>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-6 mb-4">
                    <div class="card">
                        <div class="card-body" style="background: rgb(86, 175, 13)">
                            <a href="{{ route('totalIncomeList') }}">
                                <span style="color: white">Total Income<strong></strong></span>
                                <h3 style="color: white" class="card-title text-nowrap mb-1">{{ $incomeAll }} Tk.</h3>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-6 mb-4">
                    <div class="card">
                        <div class="card-body" style="background: rgb(86, 175, 13)">
                            <a href="">
                                <span style="color: white">Cash In Hand<strong></strong></span>
                                {{-- <h3 style="color: white" class="card-title text-nowrap mb-1">{{ $cashInHand }} Tk.</h3> --}}
                            </a>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-lg-3 col-md-3 col-6 mb-4">
                    <div class="card">
                        <div class="card-body" style="background: rgb(16, 116, 16)">
                            <a href="{{ route('customer.index') }}">
                                <span style="color: white">Total Unpaid</span>
                                <h3 style="color: white" class="card-title text-nowrap mb-1">{{ $dueTotal }} Tk.</h3>
                            </a>
                        </div>
                    </div>
                </div> --}}
                <div class="col-lg-3 col-md-3 col-6 mb-4">
                    <div class="card">
                        <div class="card-body" style="background: rgb(13, 170, 97)">
                            <a href="{{ route('activeProjectList') }}">
                                <span style="color: white">Ongoing Project<strong></strong></span>
                                <h3 style="color: white" class="card-title text-nowrap mb-1">{{ $task }}</h3>
                            </a>

                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-6 mb-4">
                    <div class="card">
                        <div class="card-body" style="background: rgb(9, 173, 152)">
                            <a href="{{ route('completedProjectList') }}">
                                <span style="color: white">Completed Project</span>
                                <h3 style="color: white" class="card-title text-nowrap mb-1">{{ $completed }}</h3>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-6 mb-4">
                    <div class="card">
                        <div class="card-body" style="background: rgb(9, 140, 173)">
                            <a href="{{ route('inactiveProjectList') }}">
                                <span style="color: white">Hold Project<strong></strong></span>
                                <h3 style="color: white" class="card-title text-nowrap mb-1">{{ $taskInactive }}</h3>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-6 mb-4">
                    <div class="card">
                        <div class="card-body" style="background: rgb(12, 9, 173)">
                            <a href="{{ route('employee.create') }}">
                                <span style="color: white">Total Employee</span>
                                <h3 style="color: white" class="card-title text-nowrap mb-1">{{ $totalEmployee }}</h3>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-6 mb-4">
                    <div class="card">
                        <div class="card-body" style="background: rgb(126, 9, 173)">
                            <a href="{{ route('maintenanceList') }}">
                                <span style="color: white">Total Maintanence Project</span>
                                <h3 style="color: white" class="card-title text-nowrap mb-1">{{ $maintanenceCount }}</h3>
                            </a>
                        </div>
                    </div>
                </div>



                {{-- @foreach($coursePay as $value)
                <div class="col-lg-3 col-md-3 col-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <span></span>
                            <h3 class="card-title text-nowrap mb-1"></h3>
                        </div>
                    </div>
                </div>
            @endforeach --}}



                {{-- @foreach ($batch as $item)
                @dd($item);
                <div class="col-lg-3 col-md-3 col-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <span class="card-title text-nowrap mb-1">{{ $item->batch->batch_name }}</span>
                {{-- @foreach($totalHighStd as $value) --}}
                {{-- <span class="card-title text-nowrap mb-1"></span>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endforeach --}}

            </div>
        </div>
        <!-- Total Revenue -->
    </div>

</div>
<!-- / Content -->
@endsection
