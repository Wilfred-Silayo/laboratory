<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultation Results</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }
        .container-fluid {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        .text-primary {
            color: #007bff;
        }
        .fw-bold {
            font-weight: bold;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .table th, .table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .table th {
            background-color: #f2f2f2;
        }
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f9f9f9;
        }
        .table-striped tbody tr:nth-of-type(even) {
            background-color: #fff;
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <p style="margin-bottom: 2px; border-bottom:2px solid black;">{{$system->system_name}} {{$system->email}}</p>
    <h5>Patient name: <span class="text-primary fw-bold">{{ $consultation->patient->name }}</span></h5>
    <h6>Test Results</h6>

    <div class="table-responsive">
        <table class="table table-striped bordered">
            <thead>
                <tr>
                    <th>Consultation Date</th>
                    <th>Symptoms</th>
                    <th>Clinical Comment</th>
                    <th>Tests</th>
                    <th>Test Comments</th>
                    <th>Result Comment</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $consultation->created_at->format('Y-m-d') }}</td>
                    <td>{{ $consultation->symptom }}</td>
                    <td>{{ $consultation->order_comment }}</td>
                    <td>
                        @foreach($results as $result)
                        <span>{{ $result->test_code }}</span><br>
                        @endforeach
                    </td>
                    <td>
                        @foreach($results as $result)
                        <span>{{ $result->comment }}</span><br>
                        @endforeach
                    </td>
                    <td>{{ $consultation->lab_comment }}</td>
                </tr>
            </tbody>
        </table>
    </div>

</div>

</body>
</html>
