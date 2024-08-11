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
<body style="border: 2px solid black; margin:40px 60px 40px 60px;">
    <div style="margin:40px 60px">
        <div>
            <div style="width:40%;">
                <img style="width: 110px;height:130px;" src="{{ asset('backend/img/logo.png') }}" alt="">
            </div>
            <div style="width:60%;float:right;margin-top:-130px;text-align:right;">
                <h1 style="font-size: 18px;">ICICLE CORPORATION</h1>
                <h4 style="font-size: 14px;">House # 61 (Level 5), Road # 6/A, Anam Rangs Plaza, Dhanmondi, Dhaka–1209, Bangladesh<br>+880-9678774488, +8801985889470 Website: www.iciclecorporation.com</h4>
            </div>
        </div>
        <div style="width:100%;display:inline-block;text-align:center;border: 1px dashed black;">
            <h1 style="font-size:16px;">Advance Money Reciept</h1>
        </div>
        <div style="width:100%;display:inline-block;">
            <div style="float: left;">
                <h4>SL: {{ $invoice->customer->serial_number }}</h4>
                <h4>Invoice: {{ $invoice->invoice_no }}</h4>
                <h4>Payment Method: {{ $invoice->payment_type }}</h4>
            </div>
            <div style="float: right;">
                <h4>Date: {{ $invoice->created_at }}</h4>
                {{-- <h4>In Words: {{ $investorPay->amountInWord }}</h4> --}}
                <h4>Advance: {{ $invoice->advance }}/- </h4>
                <h4>Payment For: {{ $invoice->customer->name_or_business }}</h4>
            </div>
        </div>
        <div style="margin:190px 0 5px 0">
            <div style="">
                <div style="width: 20%;display:inline-block;">
                    <hr>
                    <p style="font-size: 14px;font-weight: 600;margin-top:-5px;text-align:center">Prepared by</p>
                </div>

                <div style="width: 20%;display:inline-block;float:right;">
                    <hr>
                    <p style="font-size: 14px;font-weight: 600;margin-top:-5px;text-align:center">Received by</p>
                </div>
            </div>
        </div>
        <div style="margin:40px 0 5px 0">
            <div style="text-align:center;">

                <div style="width: 69%;display:inline-block;text-align:center;">
                    <p style="font-size: 14px;font-weight: 500;text-align:center">
                        This money receipt will be valid subject to encashment of Cheque/P.O/D.D etc.
                    </p>
                </div>

            </div>
        </div>
    </div>
</body>
</html>
