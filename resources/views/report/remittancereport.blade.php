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
            margin: auto;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        header {
            text-align: center;
            margin-bottom: 5px;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 2px;
        }

        h3 {
            margin-top: 20px;
            /* Reduced margin for the "Remittance Report" */
            margin-bottom: 5px;
            /* Smaller space below the title */
            font-size: 20px;
        }

        p {
            margin-top: 5px;
            margin-bottom: 10px;
            /* Smaller margin below the date */
            font-size: 16px;
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

        .proof-image {
            width: 100px;
            height: auto;
            border-radius: 5px;
        }

        .total-amount {
            font-size: 12px;
            text-align: right;
            margin-top: 10px;
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
        <p><strong>From:</strong> {{ \Carbon\Carbon::parse($start)->format('F j, Y') }}</p>

        <table>
            <thead>
                <tr>
                    <th>Collector</th>
                    <th>Date</th>
                    <th>Proof</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($remittances as $index => $remittance)
                    <tr>
                        <td>
                            {{ optional($remittance->employee)->em_fname ?? '' }}
                            {{ optional($remittance->employee)->em_lname ?? '' }}
                        </td>
                        <td>{{ \Carbon\Carbon::parse($remittance->rm_date)->format('m/d/Y') }}</td>
                        <td>
                            <img src="{{ asset('storage/' . $remittance->rm_image) }}" class="proof-image"
                                alt="Proof Image" />
                        </td>
                        <td><span style="font-family: DejaVu Sans;">&#x20B1;</span>{{ $remittance->rm_amount }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <p class="total-amount"><strong>Total Amount Collected:</strong> <span
                style="font-family: DejaVu Sans;">&#x20B1;</span>{{ $remittances->sum('rm_amount') }}</p>

        <div class="prepared-by">
            <p><strong>Prepared by:</strong> Alex Ko</p>
            <p><strong>Printed date:</strong> {{ now()->format('F j, Y') }}</p>
        </div>
    </div>
</body>

</html>
