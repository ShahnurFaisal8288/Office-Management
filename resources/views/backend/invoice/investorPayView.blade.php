<!doctype html>
<html lang="en">
<style>
    @page {
        size: a4 landscape;
    }

</style>


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <title>Money Receipt</title>
</head>
<body style="border: 2px dashed black; margin:40px 60px 40px 60px;">
    <div style="margin:40px 60px">
        <div style="">
            <div style="width:40%;">
                <img style="width: 110px;height:130px;" src="{{ asset('backend/img/logo.png') }}" alt="">
            </div>
            <div style="width:60%;float:right;margin-top:-130px;text-align:right;">
                <h1 style="font-size: 18px;">ICICLE CORPORATION</h1>
                <h4 style="font-size: 14px;">House # 61 (Level 5), Road # 6/A, Anam Rangs Plaza, Dhanmondi, Dhaka–1209, Bangladesh<br>+880-9678774488, +8801985889470 Website: www.iciclecorporation.com</h4>
            </div>
        </div>
        <div style="width:100%;display:inline-block;text-align:center;border: 1px dashed black;">
            <h1 style="font-size:16px;">Money Reciept</h1>
        </div>
        <div style="width:100%;display:inline-block;">
            <div style="float: left;">
                <h4>SL: {{ $investorPay->customers->serial_number }}</h4>
                <h4>Invoice: {{ $investorPay->invoices->invoice_no }}</h4>
                <h4>TK: {{ $investorPay->total }}/- </h4>
                <h4>Payment Method: {{ $investorPay->payment_type }}</h4>


            </div>
            <div style="float: right;">
                <h4>Date: {{ $investorPay->created_at }}</h4>
                <h4>In Words: {{ $investorPay->amountInWord }}</h4>
                <h4>Payment Type: MANUAL</h4>
                <h4>Payment For: {{ $investorPay->customers->name_or_business }}</h4>
            </div>
        </div>
    </div>
</body>
</html>