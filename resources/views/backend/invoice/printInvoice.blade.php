<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice Print</title>
    <style>
        @page {
            sheet-size: A4;
            background-color: azure;
            vertical-align: top;
            margin-top: 0cm;
            margin-bottom: 0cm;
            margin-left: 0cm;
            margin-right: 0cm;
            margin-header: 0;
            margin-footer: 0;
            marks: none;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #ddd;
        }
        .invoice-items {
            margin-top: 280px;
            max-height: 400px;
            overflow-y: auto;
        }


        th,
        td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        thead {
            background-color: #f2f2f2;
        }
        table tr th{
            border: 1px solid #ddd;
        }
        .main-dev{
            position: relative;
        }
        .invoice-summary {
            margin-top: 20px;
            text-align: right;
        }
        .invoice-items thead {
            background: rgb(34, 127, 233);
            color: #fff;
        }
        .invoice-info > div {
            width: 48%;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border: 1px solid #ddd;
            word-wrap: break-word;
        }
        
        .foo{
            position: absolute;
           
            bottom: 50px;
            left: 0;
        }

    </style>
</head>
<body style="font-family: Open Sans, sans-serif; font-size: 100%; font-weight: 400; line-height: 1.4; color: #000;">
    <div style="width: 730px; margin:5px auto;" class="main-dev">
        <div style="height: 130px; border-bottom:2px solid #000; padding: 0 0 15px 0;">
            <div style="float:left;">
                <img style="height: 147px;width:150px;" src="{{ asset('backend/img/logo.png') }}" alt="" />
            </div>
            <div style="text-align:center;">
                <h1 style="margin: 42px 0 0 0!important; padding-top:20px;float:right;">ICICLE CORPORATION</h1>
            </div>
        </div>
        <h1 style="text-align: center;">Invoice</h1>
        <div style="width: 100%;">
            <div class="" style="float: left; width:36%;">
                <table>
                    <thead style="background: rgb(34, 127, 233)">
                        <tr>
                            <th>Invoice No</th>
                            <th>Date</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $invoice->invoice_no }}</td>
                            <td>{{ \Carbon\Carbon::parse($invoice->invoice_date)->format('d-M-y') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="" style="float: right; width:55%;">
                <table>
                    <thead style="background: rgb(34, 127, 233)">
                        <tr>
                            <th>Invoice To</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><b>{{ $invoice->customer->name_or_business }}</b><br>Client Name: {{ $invoice->customer->name }}<br>Address: {{ Str::limit($invoice->customer->address,35) }}<br>E-mail: {{ $invoice->customer->email }}<br>Cell: {{ $invoice->customer->phone }}<br>
                                paid: <strong>{{ $invoice->paid }}</strong><br>
                                due: <strong>{{ $invoice->due }}</strong>

                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="invoice-items" >
            <table>
                <thead>
                    <tr>
                        <th>Sl</th>
                        <th>Service & Product</th>
                        <th>Description</th>
                        <th>Qty</th>
                        <th>Sub Total</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $i = 1;
                    $totalAmount = 0; // Initialize total amount variable
                    @endphp
                    @foreach($services as $value)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $value->name }}</td>
                        <td>{{ $value->pivot->description }}</td>
                        <td>{{ $value->pivot->quantity }}</td>
                        <td>{{ $value->pivot->amount }}</td>
                        @php
                        // Add the amount to the totalAmount
                        $totalAmount += $value->pivot->amount;
                        @endphp
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="invoice-summary">
            <table>
                <tfoot>
                    <tr>
                        <td colspan="3"></td>
                        <td>Paid</td>
                        <td>{{ $invoice->advance }}</td>
                    </tr>
                    <tr>
                        <td colspan="3"></td>
                        <td>Due Amount</td>
                        <td>{{ $totalAmount - $invoice->advance }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="foo">
            <img style="width: 100%" src="{{ asset('backend/img/invoice/footer.png') }}">
        </div>
    </div>
</body>
</html>
