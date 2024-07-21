<!DOCTYPE html>
<html>

<head>
    <title>Receipt</title>
</head>

<body>

    <div class="container-fluid mt-1">
        <div class="invoice-card">
            <div class="invoice-header">
                <h1 class="mb-1">Invoice</h1>
                <p>{{$system->system_name}} {{$system->email}}</p>
            </div>
            <div class="invoice-body">
                <div class="row mb-2">
                    <h3>Patient Information</h3>
                    <p><strong>Full Name:</strong> {{ $consultation->patient->name }}</p>
                    <p><strong>Age:</strong> {{ \Carbon\Carbon::parse($consultation->patient->dob)->age }}</p>
                    <p><strong>Gender:</strong> {{ $consultation->patient->sex }}</p>
                    <p><strong>Address:</strong> {{ $consultation->patient->address }}</p>
                    <p><strong>Occupation:</strong> {{ $consultation->patient->occupation }}</p>
                    <p><strong>Visit Date:</strong> {{ $consultation->created_at->format('Y-m-d') }}</p>
                </div>
            </div>

            <h5 class="mb-3">Tests</h5>
            <table class="invoice-table">
                <thead>
                    <tr class="table-header">
                        <th>Test</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->test_code }}</td>
                        <td>{{ number_format($order->test_price, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <h4 class="total-amount">Total Amount: {{ number_format($totalAmount, 2) }}</h4>
        </div>

    </div>
    </div>

    <style>
        .invoice-card {
            border: 1px solid #ddd;
            padding: 20px;
            margin-top: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .invoice-header {
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .invoice-body {
            font-size: 14px;
        }

        .invoice-body .row {
            margin-bottom: 20px;
        }

        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .invoice-table th,
        .invoice-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .invoice-table th {
            background-color: #f8f8f8;
        }

        .total-amount {
            text-align: right;
            font-size: 16px;
            font-weight: bold;
        }
    </style>

</body>

</html>