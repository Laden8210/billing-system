<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Remittance Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            max-width: 900px;
            margin: 0 auto;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        
        header {
            text-align: center; /* Centering the header */
        }

        h1 {
            font-size: 24px;
            margin-bottom: 10px; /* Adjusted to give space between the headers */
        }

        .report-header {
            text-align: left;
            margin-bottom: 30px;
        }

        h2 {
            margin-top: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table thead {
            background-color: #f0f0f0;
        }

        table th,
        table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            font-size: 12px;
        }

        table th {
            font-weight: bold;
        }

        .summary,
        .prepared-by {
            margin-top: 20px;
        }

        .summary p,
        .prepared-by p {
            margin: 5px 0;
            font-size: 16px;
        }

        .summary p strong,
        .prepared-by p strong {
            font-weight: bold;
        }

        /* Styles for images in the table */
        .proof-image {
            width: 100px;
            height: auto;
            border-radius: 5px;
        }
        
        .location-name {
            font-size: 0.7em; 
            font-weight: normal;
            color: #333;
        }
    </style>
</head>

<body>
    <div class="container">
        <header>
            <h1>JCLC Internet Service</h1>
            <h1><span class="location-name">Urban 2, Koronadal City</span></h1>
            <hr>
        </header>

        <h3>Remittance Report</h3>
        <p><strong>From:</strong> {{$start ." - ".  $end}}</p>
        <p><strong>Area:</strong> {{$areaName}}</p>

        <table>
            <thead>
                <tr>
                    <th>Employee</th>
                    <th>Date</th>
                    <th>Amount</th>
                    <th>Proof</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($remittances as $index => $remittance)
                @php
                    // Dummy employee names
                    $dummyEmployees = [
                        ['em_fname' => 'Jasper', 'em_lname' => 'Delacruz'],
                    ];

                    // Get the current employee's dummy name based on the index
                    $employee = $dummyEmployees[$index % count($dummyEmployees)];
                @endphp
                    <tr>
                        <td>{{ $employee['em_fname'] }} {{ $employee['em_lname'] }}</td>
                        <td>{{ $remittance->rm_date }}</td>
                        <td>{{ $remittance->rm_amount }}</td>
                        <td>
                            <img src="{{ asset('storage/' . $remittance->rm_image) }}" class="proof-image" alt="Proof Image" />
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="prepared-by">
            <p><strong>Prepared by:</strong> Alex Ko</p>
            <p><strong>Printed date:</strong> {{ now()->format('m-d-Y') }}</p>
        </div>
    </div>
</body>

</html>
