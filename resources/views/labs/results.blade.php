<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultation Results</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fff;
            color: #333;
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }

        .container-fluid {
            max-width: 900px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            display: flex;
            align-items: center;
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .header img {
            height: 60px;
            margin-right: 20px;
        }

        .header div {
            font-size: 18px;
        }

        .header div p {
            margin: 0;
        }

        h5, h6 {
            margin-top: 0;
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
            padding: 10px;
            text-align: left;
        }

        .table th {
            background-color: #f2f2f2;
            text-align: center;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f9f9f9;
        }

        .table-striped tbody tr:nth-of-type(even) {
            background-color: #fff;
        }

        .table-responsive {
            overflow-x: auto;
        }

        .patient-info {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .patient-info h5 {
            width: 48%;
        }
    </style>
</head>

<body>

    <div class="container-fluid">
        <div class="header">
            <!-- Uncomment and set the src to your logo path -->
            <!-- <img src="{{ asset('path/to/your/logo.png') }}" alt="Logo"> -->
            <div>
                <p>{{ $system->system_name }}</p>
                <p>{{ $system->email }}</p>
            </div>
        </div>

        <div class="patient-info">
            <h5>Patient Name: <span class="text-primary fw-bold">{{ $consultation->patient->name }}</span></h5>
            <h5>Patient Gender: <span class="text-primary fw-bold">{{ $consultation->patient->sex }}</span></h5>
            <h5>Patient DOB: <span class="text-primary fw-bold">{{ $consultation->patient->dob }}</span></h5>
            <h5>Patient Address: <span class="text-primary fw-bold">{{ $consultation->patient->address }}</span></h5>
            <h5>Patient Phone: <span class="text-primary fw-bold">{{ $consultation->patient->phone }}</span></h5>
            <h5>Visit Date: <span class="text-primary fw-bold">{{ $consultation->created_at->format('Y-m-d') }}</span></h5>
        </div>

        <h5>Test Results</h5>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Consultation Date</th>
                        <th>Consultation Notes</th>
                        <th>Plan</th>
                        <th>Tests</th>
                        <th>Lab Results</th>
                        <th>General Comment</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $consultation->created_at->format('Y-m-d') }}</td>
                        <td>{{ $consultation->symptoms }}</td>
                        <td>{{ $consultation->clinical_comment }}</td>
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
                        <td>{{ $consultation->result_comment }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>
