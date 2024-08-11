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
        .foo{
            position: absolute;
           
            bottom: 0;
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
                <h1 style="margin: 42px 0 0 0!important; padding-top:60px;">ICICLE CORPORATION</h1>
            </div>
        </div>
        <h1 style="text-align: center;">Maintenance Invoice</h1>
        <div style="width: 100%;">
            <div class="" style="float: left; width:36%;">
                <table>
                    <thead style="background: rgb(34, 127, 233)">
                        <tr>
                            {{-- <th>Invoice No</th> --}}
                            <th>Date</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            {{-- <td>{{ $maintenance-> }}</td> --}}
                            <td>{{ \Carbon\Carbon::parse($maintenance->created_at)->format('d-M-y') }}</td>
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
                            <td>{{ $maintenance->customer->name }}<br>{{ Str::limit($maintenance->customer->address,35) }}<br>{{ $maintenance->customer->email }}<br>{{ $maintenance->customer->phone }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        
        <div style="width: 100%; margin-top: 200px;">
            <table>
                <thead style="background: rgb(34, 127, 233)">
                    <tr>
                        <th>Sl</th>
                        <th>Project Name</th>
                        <th>Maintenance amount</th>
                
                    </tr>
                </thead>
                <tbody>
                    {{-- @php
                    $i = 1;
                    $totalAmount = 0; // Initialize total amount variable
                    @endphp --}}
                    {{-- @foreach($maintenance as $value) --}}
                    <tr>
                        <td>1</td>
                        <td>{{ $maintenance->customer->name_or_business }}</td>
                        <td>{{ $maintenance->maintenance_amount }}</td>
                        {{-- <td>{{ $value->pivot->amount }}</td> --}}
                        {{-- @php
                        // Add the amount to the totalAmount
                        $totalAmount += $value->pivot->amount;
                        @endphp --}}
                    </tr>
                    {{-- @endforeach --}}
                </tbody>
                {{-- <tfoot>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>Total</td>
                        <td>{{ $totalAmount }}</td> <!-- Output the total amount -->
                    </tr>
                </tfoot>
                <tfoot>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>Advance</td>
                        <td>{{ $invoice->advance }}</td> <!-- Output the total amount -->
                    </tr>
                </tfoot> --}}
                {{-- <tfoot>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>Due Amount</td>
                        <td>{{ $totalAmount-$invoice->advance }}</td> <!-- Output the total amount -->
                    </tr>
                </tfoot> --}}

            </table>
        </div>
        <div class="foo">
            <img style="width: 100%" src="{{ asset('backend/img/invoice/footer.png') }}">
        </div>
    </div>
</body>
</html>
