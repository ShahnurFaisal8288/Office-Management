<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Salary Sheet</title>
    <style>
        @page {
            size: A4 landscape;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 4px;
            width: 100%;
            max-width: 1120px;
            /* Adjusted for landscape */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);

        }

        .name-column {
            width: 150px;
        }
        .designation-column{
            width: 150px;
        }

        .title {
            text-align: center;
            margin-bottom: 20px;
            font-size: 24px;
            font-weight: bold;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        .table th,
        .table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
            text-align: center;
        }

        .table th {
            background-color: #6086ac;
            color: #fff;
        }

        .table tbody tr:nth-of-type(odd) {
            background-color: #f2f2f2;
        }

        .table tfoot td {
            font-weight: bold;
            background-color: #e9ecef;
        }

        .table tfoot td.total-label {
            text-align: right;
        }

    </style>
</head>
<body>
    <div class="container">
        <div class="title">Salary Sheet</div>
        <table class="table">
            <thead>
                <tr>
                    <th>Sl</th>
                    <th class="name-column">Name</th>
                    <th class="designation-column">Designation</th>
                    <th>Amount</th>
                    <th>Month</th>
                    <th>Deliverables</th>
                    <th>Status</th>
                    <th>Remarks</th>
                </tr>
            </thead>
            <tbody>
                @php
                $totalAmount = 0;
                $currentMonth = now()->format('F');
                @endphp
                @foreach($salarySheet as $key => $value)
                @php
                $totalAmount += $value->pay_agreement;
                @endphp
                <tr>
                    <td>{{ $loop->iteration ?? '' }}</td>
                    <td class="name-column">{{ $value->name ?? '' }}</td>
                    <td class="designation-column">{{ $value->designation ?? '' }}</td>
                    <td>{{ $value->pay_agreement }}</td>
                    <td>{{ $currentMonth }}</td>
                    <td>{{ $value->salary->deliverables ?? '' }}</td>
                    <td>{{ $value->salary->status ?? 'Unpaid' }}</td>
                    <td>{{ $value->salary->remarks ?? '' }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="total-label">Total Salary Amount</td>
                    <td>{{ $totalAmount }}</td>
                    <td colspan="4"></td>
                </tr>
            </tfoot>
        </table>
    </div>
</body>
</html>
