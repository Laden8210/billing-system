<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subscribers Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
        }

        .report-container {
            background-color: #fff;
            padding: 20px;
            max-width: 900px;
            margin: 0 auto;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 24px;
            text-align: center;
            margin-bottom: 20px; /* Adjust this if needed */
        }

        .report-header {
            text-align: left;
            margin-bottom: 20px; /* Reduced from 30px to 20px */
        }

        h3 {
            margin: 10px 0; /* Reduced top and bottom margins for h3 */
            font-size: 18px; /* Optionally adjust font size */
        }

        p {
            margin: 2px 0; /* Reduced margin for paragraphs */
            font-size: 14px; /* Optionally adjust font size */
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

        .location-name {
            font-size: 0.7em;
            font-weight: normal;
            color: #333;
        }
    </style>
</head>

<body>
    <div class="report-container">
        <div class="report-header">
            <header>
                <h1>JCLC Internet Service</h1>
                <h1><span class="location-name">Urban 2, Koronadal City</span></h1>

                <hr>
            </header>

            <h3>Subscriber Report</h3>
            <p><strong>From:</strong> {{ \Carbon\Carbon::parse($start)->format('F j, Y') }} - {{ \Carbon\Carbon::parse($end)->format('F j, Y') }}</p>
            <p><strong>Area:</strong> {{$areaName}}</p>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Subscriber ID</th>
                    <th>Subscriber Name</th>
                    <th>Contact Number</th>
                    <th>Address</th>
                    <th>Number of Subscriptions</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($subscribers as $subscriber)
                    <tr>
                        <td>{{ $subscriber->subscriber_id }}</td>
                        <td>{{ $subscriber->sr_fname . ' ' . $subscriber->sr_lname }}</td>
                        <td>{{ $subscriber->sr_contactnum }}</td>
                        <td>{{ $subscriber->sr_street . ' ' . $subscriber->sr_barangay . ' ' . $subscriber->sr_city }}</td>
                        <td>{{ $subscriber->subscriptions->count() }}</td>
                        <td>{{ $subscriber->sr_status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="summary">
            <p><strong>Number of Subscriber:</strong> {{$subscribers->count()}}</p>
        </div>

        <div class="prepared-by">
            <p><strong>Prepared By:</strong> {{ Auth::user()->em_fname . ' ' . Auth::user()->em_lname }}</p>
            <p><strong>Date:</strong> {{ now()->format('m/d/Y') }}</p>
        </div>
    </div>
</body>

</html>
