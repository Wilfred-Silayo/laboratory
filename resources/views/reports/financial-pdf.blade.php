<!-- resources/views/report_pdf.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Financial Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .container {
            width: 100%;
            margin: 0 auto;
        }

        .header,
        .footer {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h3 {
            margin: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .text-right {
            text-align: right;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h3>Financial Report for {{ request('month') }}</h3>
            <p style="margin-bottom: 2px; border-bottom:2px solid black; text-align:left;">{{$system->system_name}} {{$system->email}}</p>
        </div>
        <table>
            <thead>
                <tr>
                    <th>PID</th>
                    <th>Full Name</th>
                    <th>Date of Birth</th>
                    <th>Gender</th>
                    <th>Visit Date</th>
                    <th>Lab Tests</th>
                    <th>Total Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach($consultations as $consultation)
                <tr>
                    <td>{{ $consultation->patient->id }}</td>
                    <td>{{ $consultation->patient->name }}</td>
                    <td>{{ $consultation->patient->dob }}</td>
                    <td>{{ $consultation->patient->sex }}</td>
                    <td>{{ $consultation->visit_date }}</td>
                    <td>
                        <ul>
                            @foreach($consultation->orders as $order)
                            <li>{{ $order->test_code }} - ${{ $order->test_price }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td class="text-right">${{ $consultation->account->total_amount }}</td>
                </tr>

                @endforeach
            </tbody>
        </table>

        <div class="footer">
            <p>Generated on {{ \Carbon\Carbon::now()->format('Y-m-d') }}</p>
        </div>
    </div>
</body>

</html>