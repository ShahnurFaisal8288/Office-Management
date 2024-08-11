@extends('backend.partials.app')
@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    h3,
    h1,
    h2,
    h5,
    h6,
    p,
    td,
    th,
    table,
    tr span {
        color: black
    }
</style>
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
                                            <form method="post" enctype="multipart/form-data">
                                                @csrf
                                                <div class="row my-3">
                                                    <div class="col-md-3">
                                                        <label for="serial_No" class="my-2">Client</label>
                                                        <select name="invoice_no" id="serial_No" class="form-control my-2">
                                                            <option value="">Select Serial ID</option>
                                                            @foreach ($invoice as $value)
                                                            <option value="{{ $value->customer_id }}">{{ $value->customer->name_or_business }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="name" class="my-2">Name</label>
                                                        <input type="text" name="name" id="name" class="form-control">
                                                    </div>
                                                    {{-- <div class="col-md-3">
                                                        <label for="project_name" class="my-2">Project Title</label>
                                                        <input type="text" name="project_name" id="project_name" class="form-control">
                                                    </div> --}}




                                                    {{-- <div class="col-md-3">
                                                        <label for="strat_from" class="my-2">Start Date</label>
                                                        <input type="text" name="start_from" id="strat_from" class="form-control ">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="strat_to" class="my-2">End Date</label>
                                                        <input type="text" name="start_to" id="strat_to" class="form-control ">
                                                    </div> --}}
                                                    {{-- <div class="col-md-3">
                                                        <label for="total_inst" class="my-2">Total Installment</label>
                                                        <input type="text" name="total_inst" id="total_inst" class="form-control ">
                                                    </div> --}}



                                                    {{-- <div class="col-md-3">
                                                        <label for="per_int_amount" class="my-2">Per Installment amount</label>
                                                        <input type="text" name="per_int_amount" id="per_int_amount" class="form-control ">
                                                    </div> --}}


                                                    {{-- <div class="col-md-3">
                                                        <label for="per_int_amount_word" class="my-2">Per Installment Amount(Word)</label>
                                                        <input type="text" name="per_int_amount_word" id="per_int_amount_word" class="form-control">
                                                    </div> --}}
                                                    <div class="col-md-3 mb-4">
                                                        <label class="form-label my-2" for="allow_amount">Total Cost</label>
                                                        <input class="form-control" name="allow_amount" id="allow_amount">

                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="form-label my-2" for="main_amount">Advance Amount</label>
                                                        <input type="number" class="form-control" name="main_amount" id="afterAdvance" />
                                                    </div><br>
                                                    <div class="col-md-3">
                                                        <label for="bank_name" class="my-2">Bank Name</label>
                                                        <input type="text" name="bank_name" id="bank_name" class="form-control">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="branch_name" class="my-2">Branch Name</label>
                                                        <input type="text" name="branch_name" id="branch_name" class="form-control">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="amountInWord" class="my-2">Amount in Word</label>
                                                        <input type="text" name="amountInWord" id="amountInWord" class="form-control">
                                                    </div>

                                                    <div class="col-md-3">
                                                        <label class="form-label my-2" for="payment_type2">Payment Type</label>
                                                        <select class="form-control" name="payment_type" id="payment_type">
                                                            <option value="">Select Payment Type</option>
                                                            <option value="cash">Cash</option>
                                                            <option value="chq">CHQ</option>
                                                            <option value="Online Payment">Online Payment ( Bank to Bank)</option>

                                                        </select>
                                                    </div>
                                                    <div class="col-md-3">
                                                       
                                                        <input type="hidden" name="invoice_id" id="invoice_id" class="form-control">
                                                    </div>
                                                </div>
                                                <hr>
                                                {{-- <div class="col-md-2">
                                                    <label for="number_installment_upcomming">Installment Number</label>
                                                    <input type="text" name="number_installment_upcomming" id="number_installment_upcomming" class="form-control">
                                                </div> --}}
                                                <div class="row my-3">
                                                    <h4>Payment Information</h4>
                                                    <div class="col-md-6">
                                                        <label for="branch_name" class="my-2">Paid</label>
                                                        <input type="text" name="invpaid" id="invPaid" class="form-control" readonly>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="branch_name" class="my-2">Due</label>
                                                        <input type="text" name="invdue" id="invDue" class="form-control" readonly>
                                                    </div>
                                                    <!-- start sharif -->
                                                    <input type="hidden" id="hidden">
                                                    <!-- quarterly -->
                                                    <input type="hidden" id="quarterly">
                                                    <!-- half yearly -->
                                                    <input type="hidden" id="half_yearly">
                                                    <!-- yearly -->
                                                    <input type="hidden" id="yearly">
                                                    <!-- end sharif -->
                                                    <h4 style="color: rgb(143, 13, 13)" id="unpaidMonth"></h4>
                                                    <div class="table-responsive">
                                                        <table class="table table-stipe table-bordered table-hover">
                                                            <thead>
                                                                <tr>
                                                                    {{-- <th><strong>Fee Name</strong></th>
                                                                    <th><strong>Month From</strong></th>
                                                                    <th><strong>Month To</strong></th> --}}
                                                                    <th><strong>Amount</strong></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="paymentTable">
                                                                <tr>
                                                                    {{-- <td>Monthly Pay</td>
                                                                    <td>
                                                                        <input type="month" class="form-control" name="start_month" id="start_month" readonly>
                                                                    </td>
                                                                    <td>
                                                                        <input type="month" class="form-control" name="end_month" id="end_month">
                                                                    </td> --}}
                                                                    <td>
                                                                        <input type="text" class="form-control" name="total" id="GrandTotal">
                                                                    </td>
                                                                    <td>
                                                                        <input type="hidden" class="form-control" name="quarterly" id="quarterly">
                                                                    </td>
                                                                </tr>
                                                            </tbody>

                                                        </table>
                                                    </div>
                                                </div>
                                                <input type="submit" value="Submit" class="btn btn-primary">
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
@push('js')
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#image').change('click', function(e) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>
<script>
    setTimeout(() => {
        $('.timeout').fadeOut('slow')
    }, 3000);
</script>
<script>
    $(document).ready(function() {
        $('#serial_No').select2();
    });
</script>

<!-- start sharif -->
<script>
    // function perMonth() {
    //     $('#start_month, #end_month').on('change', function() {
    //         var start_month = $('#start_month').val();
    //         var end_month = $('#end_month').val();
    //         if (start_month && end_month) {
    //             var start_date = new Date(start_month);
    //             var end_date = new Date(end_month);
    //             var monthsDifference = 0;
    //             // monthly
    //             while (start_date <= end_date) {
    //                 monthsDifference++;
    //                 start_date.setMonth(start_date.getMonth() + 1);
    //             }
    //         }
    //         let numberInst = $('#number_installment_upcomming').val();
    //         let result = $('#hidden').val();
    //         let division = monthsDifference / result;
    //         let sum = Math.round(Number(division) + Number(numberInst) - 1);
    //         $('#number_installment_upcomming').val(sum);
    //     });
    // };
    // perMonth();

    // function quaterlyMonth() {
    //     let quarterly = $('#quarterly').val();
    //     let half_yearly = $('#half_yearly').val();
    //     let yearly = $('yearly').val();

    //     $('#start_month, #end_month').on('change', function() {
    //         var start_month = $('#start_month').val();
    //         var end_month = $('#end_month').val();

    //         if (start_month && end_month) {
    //             var start_date = new Date(start_month);
    //             var end_date = new Date(end_month);
    //             var monthsDifference = 0;

    //             if (quarterly) {
    //                 while (start_date <= end_date) {
    //                     monthsDifference++;
    //                     start_date.setMonth(start_date.getMonth() + 3);
    //                 }
    //             } else if (half_yearly) {
    //                 while (start_date <= end_date) {
    //                     monthsDifference++;
    //                     start_date.setMonth(start_date.getMonth() + 6);
    //                 }
    //             }else if (yearly){
    //                 while (start_date <= end_date) {
    //                     monthsDifference++;
    //                     start_date.setMonth(start_date.getMonth() + 12);
    //                 }
    //             }

    //             let numberInst = $('#number_installment_upcoming').val();
    //             let result = $('#hidden').val();
    //             let division = monthsDifference / result;
    //             let sum = Math.round(Number(division) + Number(numberInst) - 1);
    //             $('#number_installment_upcoming').val(sum);
    //         }
    //     });
    // }

    // quaterlyMonth();
</script>
<!-- end sharif -->

{{-- ajax pay --}}
<script>
    $(document).ready(function() {
        $('#serial_No').change(function() {
            var serial_No = $(this).val();
            //   let currentDate = new Date().toJSON().slice(0, 10);
            $.ajax({
                url: '/getName',
                type: 'get',
                dataType: 'json',
                data: 'serial_No=' + serial_No,
                success: function(data) {
                    console.log(data[1]);
                    $('#name').val(data[0].customer.name);
                    $('#project_name').val(data[0].customer.name_or_business);
                    $('#unPaid_amount').val(data[0].agreed_price);
                    $('#allow_amount').val(data[0].total_amount);
                    $('#afterAdvance').val(data[0].advance);
                    $('#invoice_id').val(data[0].id);
                    let totalInsMent = data[6];
                    $('#hidden').val(totalInsMent);

                    let unPaidInstallment = data[4];
                    if (unPaidInstallment && unPaidInstallment.number_installment_upcomming !== undefined) {
                        let newValue = parseInt(unPaidInstallment.number_installment_upcomming) + 1;
                        $('#number_installment_upcomming').val(newValue);
                    } else {
                        $('#number_installment_upcomming').val(unPaidInstallment + 1);
                    }
                    // end sharif

                    $('#invPaid').val(data[1]);
                    if (data[2] >= 0) {
                        $('#invDue').val(data[2]);

                    } else {
                        $('#invDue').val(0);
                    }

                    let quarterly = data[0].quarterly;
                    $('#quarterly').val(quarterly);
                    let half_yearly = data[0].half_yearly;
                    $('#half_yearly').val(half_yearly);
                    let yearly = data[0].yearly;
                    $('#yearly').val(yearly);
                    let at_a_time = data[0].at_a_time;
                    let paidMonths = data[1] + '-10';
                    let startDate = data[0].start_from;
                    let unpaidMonths = 0;
                    let currentDate = data[0].start_to;

                    // console.log(startDate);
                    // console.log(currentDate);

                    if (quarterly) {

                        if (data[1] == 'null') {
                            let newDate = new Date(startDate);
                            let nextPay = getThirdMonthStartDate(newDate);

                            var startFromFormatted = formatDateForInput(startDate);
                            var endFromFormatted = formatDateForInput(nextPay);

                            // Set the 'start_from' data to 'start_month' and 'end_month'
                            $('#start_month').val(startFromFormatted);
                            $('#end_month').val(endFromFormatted);
                            unpaidMonths = getUniqueQuarterlyMonthNames(startDate, currentDate);
                            calculateUnpaidInstallment();
                        } else {
                            let paid = new Date(paidMonths);
                            let dateInput = getNextMonthDate(paid)
                            let nextPay = getThirdMonthDate(paid)
                            var startFromFormatted = formatDateForInput(dateInput);
                            var endFromFormatted = formatDateForInput(nextPay);

                            // Set the 'start_from' data to 'start_month' and 'end_month'
                            $('#start_month').val(startFromFormatted);
                            $('#end_month').val(endFromFormatted);
                            unpaidMonths = getUniqueQuarterlyMonthNamesPaid(paidMonths, currentDate);
                            calculateUnpaidInstallment();
                        }
                        $('#unpaidMonth').html("Unpaid months up to now: " + unpaidMonths.join("- "));

                    } else if (half_yearly) {
                        if (data[1] == 'null') {
                            let newDate = new Date(startDate);
                            let nextPay = getHalf_yearlyStartDate(newDate);


                            var startFromFormatted = formatDateForInput(startDate);
                            var endFromFormatted = formatDateForInput(nextPay);

                            // Set the 'start_from' data to 'start_month' and 'end_month'
                            $('#start_month').val(startFromFormatted);
                            $('#end_month').val(endFromFormatted);
                            unpaidMonths = getUniqueQHalf_yearlyMonthNames(startDate, currentDate);


                            calculateHalf_yearlyInstallment();
                        } else {
                            let paid = new Date(paidMonths);

                            let dateInput = getNextMonthDate(paid)
                            let nextPay = getsixthMonthDate(paid)
                            var startFromFormatted = formatDateForInput(dateInput);
                            var endFromFormatted = formatDateForInput(nextPay);

                            // Set the 'start_from' data to 'start_month' and 'end_month'
                            $('#start_month').val(startFromFormatted);
                            $('#end_month').val(endFromFormatted);
                            unpaidMonths = getUniqueQHalf_yearlyMonthNamesPaid(paidMonths, currentDate);
                            calculateHalf_yearlyInstallment();
                        }
                        $('#unpaidMonth').html("Unpaid months up to now: " + unpaidMonths.join("- "));
                    } else if (yearly) {
                        if (data[1] == 'null') {
                            let newDate = new Date(startDate);
                            let nextPay = getYearlyStartDate(newDate);

                            var startFromFormatted = formatDateForInput(startDate);
                            var endFromFormatted = formatDateForInput(nextPay);

                            // Set the 'start_from' data to 'start_month' and 'end_month'
                            $('#start_month').val(startFromFormatted);
                            $('#end_month').val(endFromFormatted);
                            unpaidMonths = getUniqueYearlyMonthNames(startDate, currentDate);


                            calculateYearlyInstallment();
                        } else {
                            let paid = new Date(paidMonths);

                            let dateInput = getNextMonthDate(paid)
                            let nextPay = getsixthMonthDate(paid)
                            var startFromFormatted = formatDateForInput(dateInput);
                            var endFromFormatted = formatDateForInput(nextPay);

                            // Set the 'start_from' data to 'start_month' and 'end_month'
                            $('#start_month').val(startFromFormatted);
                            $('#end_month').val(endFromFormatted);
                            unpaidMonths = getUniqueYearlyMonthNamesPaid(paidMonths, currentDate);
                            calculateYearlyInstallment();
                        }
                        $('#unpaidMonth').html("Unpaid months up to now: " + unpaidMonths.join("- "));
                    } else if (at_a_time) {

                    } else {

                        if (data[1] != 'null') {
                            let paid = new Date(paidMonths);
                            let dateInput = getNextMonthDate(paid)

                            var startFromFormatted = formatDateForInput(dateInput);

                            // Set the 'start_from' data to 'start_month' and 'end_month'
                            $('#start_month').val(startFromFormatted);
                            $('#end_month').val(startFromFormatted);

                            unpaidMonths = getPaidMonthNames(paidMonths, currentDate);
                            calculateUnpaidInstallments()
                        } else {
                            var startFromFormatted = formatDateForInput(data[0].start_from);

                            // Set the 'start_from' data to 'start_month' and 'end_month'
                            $('#start_month').val(startFromFormatted);
                            $('#end_month').val(startFromFormatted);

                            unpaidMonths = getMonthNames(startDate, currentDate);
                            calculateUnpaidInstallments()
                        }
                        $('#unpaidMonth').html("Unpaid months up to now: " + unpaidMonths.join(","));
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });

    function formatDateForInput(date) {
        var formattedDate = new Date(date);
        var yyyy = formattedDate.getFullYear();
        var mm = (formattedDate.getMonth() + 1).toString().padStart(2, '0');
        return yyyy + '-' + mm;
    }

    function getMonthNames(startDate, endDate) {
        let start = new Date(startDate);
        let end = new Date(endDate);
        let monthNames = [];

        while (start <= end) {
            monthNames.push(start.toLocaleString('default', {
                month: 'long'
            }));
            start.setMonth(start.getMonth() + 1);
        }

        return monthNames;
    }

    function getPaidMonthNames(startDate, endDate) {
        let start = new Date(startDate);
        let end = new Date(endDate);
        let monthNames = [];
        let result = [];
        let startMonth = start.toLocaleString('default', {
            month: 'long'
        });

        while (start <= end) {
            monthNames.push(start.toLocaleString('default', {
                month: 'long'
            }));
            start.setMonth(start.getMonth() + 1);
        }

        for (let i = 0; i < monthNames.length; i++) {
            if (monthNames[i] === startMonth) {
                let spliced = monthNames.splice(i, 1);
                console.log("Remaining elements: " + monthNames);
            }
        }
        return monthNames;
    }

    function getUniqueQuarterlyMonthNames(startDate, endDate) {
        let currentDate1 = new Date(startDate);
        const endDateTime = new Date(endDate);

        const monthNames = [];
        while (currentDate1 <= endDateTime) {
            const monthName = new Intl.DateTimeFormat('en-US', {
                month: 'long'
            }).format(currentDate1);
            console.log(monthName);

            monthNames.push(monthName);
            currentDate1.setMonth(currentDate1.getMonth() + 1);
        }

        console.log(monthNames);
        const quarters = [];
        for (let i = 0; i < monthNames.length; i += 3) {
            const quarter = monthNames.slice(i, i + 3);
            quarters.push(quarter);
        }

        const uniqueQuarterNames = quarters.map(quarter => [...new Set(quarter)]);

        return uniqueQuarterNames;
    }
    //getUniqueYearlyMonthNames
    function getUniqueYearlyMonthNames(startDate, endDate) {
        let currentDate = new Date(startDate);
        const endDateTime = new Date(endDate);

        const monthNames = [];
        while (currentDate <= endDateTime) {
            const monthName = new Intl.DateTimeFormat('en-US', {
                month: 'long'
            }).format(currentDate);

            monthNames.push(monthName);
            currentDate.setMonth(currentDate.getMonth() + 1);
        }

        const halfYears = [];
        for (let i = 0; i < monthNames.length; i += 12) {
            const halfYear = monthNames.slice(i, i + 12);
            halfYears.push(halfYear);
        }

        const uniqueHalfYearNames = halfYears.map(halfYear => [...new Set(halfYear)]);

        return uniqueHalfYearNames;
    }
    //End getUniqueYearlyMonthNames
    //half_yearly
    function getUniqueQHalf_yearlyMonthNames(startDate, endDate) {
        let currentDate = new Date(startDate);
        const endDateTime = new Date(endDate);

        const monthNames = [];
        while (currentDate <= endDateTime) {
            const monthName = new Intl.DateTimeFormat('en-US', {
                month: 'long'
            }).format(currentDate);

            monthNames.push(monthName);
            currentDate.setMonth(currentDate.getMonth() + 1);
        }

        const halfYears = [];
        for (let i = 0; i < monthNames.length; i += 6) {
            const halfYear = monthNames.slice(i, i + 6);
            halfYears.push(halfYear);
        }

        const uniqueHalfYearNames = halfYears.map(halfYear => [...new Set(halfYear)]);

        return uniqueHalfYearNames;
    }
    // Quarterly
    function getUniqueQuarterlyMonthNamesPaid(startDate, endDate) {
        let currentDate2 = new Date(startDate);
        const endDateTime = new Date(endDate);

        const monthNames = [];
        console.log(currentDate2);
        console.log(endDateTime);

        while (currentDate2 <= endDateTime) {
            const monthName = new Intl.DateTimeFormat('en-US', {
                month: 'long'
            }).format(currentDate2);
            console.log(monthName);

            monthNames.push(monthName);
            currentDate2.setMonth(currentDate2.getMonth() + 1);
        }


        const quarters = [];
        for (let i = 1; i < monthNames.length; i += 3) {
            const quarter = monthNames.slice(i, i + 3);
            quarters.push(quarter);
        }

        const uniqueQuarterNames = quarters.map(quarter => [...new Set(quarter)]);
        console.log(uniqueQuarterNames);
        return uniqueQuarterNames;
    }
    // Half_yearly
    function getUniqueQHalf_yearlyMonthNamesPaid(startDate, endDate) {
        let currentDate2 = new Date(startDate);
        const endDateTime = new Date(endDate);

        const monthNames = [];
        while (currentDate2 <= endDateTime) {
            const monthName = new Intl.DateTimeFormat('en-US', {
                month: 'long'
            }).format(currentDate2);

            monthNames.push(monthName);
            currentDate2.setMonth(currentDate2.getMonth());
        }

        const halfYears = [];
        for (let i = 1; i < monthNames.length; i += 6) {
            const halfYear = monthNames.slice(i, i + 6);
            halfYears.push(halfYear);
        }

        const uniqueHalfYearNames = halfYears.map(halfYear => [...new Set(halfYear)]);

        return uniqueHalfYearNames;

    }

    //getUniqueYearlyMonthNamesPaid
    function getUniqueYearlyMonthNamesPaid(startDate, endDate) {
        let currentDate2 = new Date(startDate);
        const endDateTime = new Date(endDate);

        const monthNames = [];
        while (currentDate2 <= endDateTime) {
            const monthName = new Intl.DateTimeFormat('en-US', {
                month: 'long'
            }).format(currentDate2);

            monthNames.push(monthName);
            currentDate2.setMonth(currentDate2.getMonth() + 1);
        }

        const halfYears = [];
        for (let i = 1; i < monthNames.length; i += 12) {
            const halfYear = monthNames.slice(i, i + 12);
            halfYears.push(halfYear);
        }

        const uniqueHalfYearNames = halfYears.map(halfYear => [...new Set(halfYear)]);

        return uniqueHalfYearNames;

    }
    // End getUniqueYearlyMonthNamesPaid

    function getNextMonthDate(inputDate) {
        if (!(inputDate instanceof Date) || isNaN(inputDate)) {
            throw new Error('Invalid Date');
        }
        // Get the month and year from the input date
        var currentMonth = inputDate.getMonth();
        var currentYear = inputDate.getFullYear();

        // Calculate the next month
        var nextMonth = (currentMonth + 1) % 12; // Use modulo to handle December (month 11)
        var nextYear = currentYear + Math.floor((currentMonth + 1) / 12); // Increment year if next month is January

        // Create a new Date object for the next month
        var nextMonthDate = new Date(nextYear, nextMonth, inputDate.getDate());

        return nextMonthDate;
    }

    function getThirdMonthDate(inputDate) {
        // Check if inputDate is a valid Date object
        if (!(inputDate instanceof Date) || isNaN(inputDate)) {
            throw new Error('Invalid Date');
        }

        // Get the month and year from the input date
        var currentMonth = inputDate.getMonth();
        var currentYear = inputDate.getFullYear();

        // Calculate the third month
        var thirdMonth = (currentMonth + 3) % 12; // Use modulo to handle December (month 11)
        var thirdYear = currentYear + Math.floor((currentMonth + 3) / 12); // Increment year if third month is January or later

        // Create a new Date object for the third month
        var thirdMonthDate = new Date(thirdYear, thirdMonth);

        return thirdMonthDate;
    }

    function getsixthMonthDate(inputDate) {
        // Check if inputDate is a valid Date object
        if (!(inputDate instanceof Date) || isNaN(inputDate)) {
            throw new Error('Invalid Date');
        }

        // Get the month and year from the input date
        var currentMonth = inputDate.getMonth();
        var currentYear = inputDate.getFullYear();

        // Calculate the third month
        var thirdMonth = (currentMonth + 6) % 12; // Use modulo to handle December (month 11)
        var thirdYear = currentYear + Math.floor((currentMonth + 6) / 12); // Increment year if third month is January or later

        // Create a new Date object for the third month
        var thirdMonthDate = new Date(thirdYear, thirdMonth);

        return thirdMonthDate;
    }
    // Quarterly
    function getThirdMonthStartDate(inputDate) {
        // Check if inputDate is a valid Date object
        if (!(inputDate instanceof Date) || isNaN(inputDate)) {
            throw new Error('Invalid Date');
        }

        // Get the month and year from the input date
        var currentMonth = inputDate.getMonth();
        var currentYear = inputDate.getFullYear();

        // Calculate the third month
        var thirdMonth = (currentMonth + 2) % 12; // Use modulo to handle December (month 11)
        var thirdYear = currentYear + Math.floor((currentMonth + 2) / 12); // Increment year if third month is January or later

        // Create a new Date object for the third month
        var thirdMonthDate = new Date(thirdYear, thirdMonth);

        return thirdMonthDate;
    }
    //getYearlyStartDate
    function getYearlyStartDate(inputDate) {
        if (!(inputDate instanceof Date) || isNaN(inputDate)) {
            throw new Error('Invalid Date');
        }

        var currentMonth = inputDate.getMonth();
        var currentYear = inputDate.getFullYear();

        var halfYearMonth = (currentMonth + 11) % 12; // Add 5 to get the 6th month from the current month
        var halfYearYear = currentYear + Math.floor((currentMonth + 11) / 12);

        var halfYearDate = new Date(halfYearYear, halfYearMonth);
        console.log(halfYearDate);
        return halfYearDate;

    }
    //End getYearlyStartDate
    // Half_yearly
    function getHalf_yearlyStartDate(inputDate) {
        if (!(inputDate instanceof Date) || isNaN(inputDate)) {
            throw new Error('Invalid Date');
        }

        var currentMonth = inputDate.getMonth();
        var currentYear = inputDate.getFullYear();

        var halfYearMonth = (currentMonth + 5) % 12; // Add 5 to get the 6th month from the current month
        var halfYearYear = currentYear + Math.floor((currentMonth + 5) / 12);

        var halfYearDate = new Date(halfYearYear, halfYearMonth);
        console.log(halfYearDate);
        return halfYearDate;

    }

    // Quarterly
    // function calculateUnpaidInstallment() {
    //     var perIntAmount = parseFloat($("#per_int_amount").val());
    //     var startMonth = new Date($("#start_month").val());
    //     var endMonth = new Date($("#end_month").val());


    //     var totalQuarters = Math.ceil(Math.abs((endMonth.getFullYear() - startMonth.getFullYear()) * 12 + endMonth.getMonth() - startMonth.getMonth()) / 3);
    //     console.log(totalQuarters);

    //     var unpaidAmount = perIntAmount * totalQuarters;

    //     $("#GrandTotal").val(unpaidAmount.toFixed(2));
    //     $("#GrandTotal_1").html(unpaidAmount.toFixed(2));
    // }

    // $("#start_month, #end_month").on("input", function() {
    //     calculateUnpaidInstallment();
    // });
    // Half_yearly
    // function calculateHalf_yearlyInstallment() {
    //     var perIntAmount = parseFloat($("#per_int_amount").val());
    //     var startMonth = new Date($("#start_month").val());
    //     var endMonth = new Date($("#end_month").val());

    //     var totalHalfYears = Math.ceil(Math.abs((endMonth.getFullYear() - startMonth.getFullYear()) * 12 + endMonth.getMonth() - startMonth.getMonth()) / 6);

    //     // var unpaidAmount = perIntAmount * totalHalfYears;
    //     var unpaidAmount = perIntAmount;
    //     $("#GrandTotal").val(unpaidAmount.toFixed(2));
    //     $("#GrandTotal_1").html(unpaidAmount.toFixed(2));
    // }
    // $("#start_month, #end_month").on("input", function() {
    //     calculateHalf_yearlyInstallment();
    // });
    //Yearly

    // function calculateYearlyInstallment() {
    //     var perIntAmount = parseFloat($("#per_int_amount").val());
    //     var startMonth = new Date($("#start_month").val());
    //     var endMonth = new Date($("#end_month").val());

    //     var totalHalfYears = Math.ceil(Math.abs((endMonth.getFullYear() - startMonth.getFullYear()) * 12 + endMonth.getMonth() - startMonth.getMonth()) / 12);

    //     // var unpaidAmount = perIntAmount * totalHalfYears;
    //     var unpaidAmount = perIntAmount;
    //     $("#GrandTotal").val(unpaidAmount.toFixed(2));
    //     $("#GrandTotal_1").html(unpaidAmount.toFixed(2));
    // }
    // $("#start_month, #end_month").on("input", function() {
    //     calculateYearlyInstallment();
    // });
    // per month
    // function calculateUnpaidInstallments() {
    //     var perIntAmount = parseFloat($("#per_int_amount").val());
    //     var startMonth = new Date($("#start_month").val());
    //     var endMonth = new Date($("#end_month").val());
    //     var totalMonths = Math.abs((endMonth.getFullYear() - startMonth.getFullYear()) * 12 + endMonth.getMonth() - startMonth.getMonth()) + 1;
    //     var unpaidAmount = perIntAmount * totalMonths;
    //     $("#GrandTotal").val(unpaidAmount.toFixed(2));
    //     $("#GrandTotal_1").html(unpaidAmount.toFixed(2));
    // }
    // Attach change event to start_month and end_month inputs
    // $("#start_month, #end_month").on("input", function() {
    //     calculateUnpaidInstallments();
    // });

    //installment has
</script>

@endpush
