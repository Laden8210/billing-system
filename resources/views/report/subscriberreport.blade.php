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
            text-align: left;
            margin-bottom: 20px;
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
    </style>
</head>

<body>
    <div class="report-container">
        <div class="report-header">


            <header>
                <h1>JCLC Internet Servece</h1>
                <p><strong>From:</strong> {{$start ."-".  $end}}</p>
                <p><strong>Area:</strong> {{$areaName}}</p>
                <hr>
            </header>

            <h3>Subscriber Report</h3>

        </div>

        <table>
            <thead>
                <tr>
                    <th>SUBSCRIBERID</th>
                    <th>Subscriber Name</th>
                    <th>Contact Number</th>
                    <th>Address</th>
                    <th>Number of Subscription</th>
                    <th>STATUS</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($subscribers as $subscriber)
                    <tr>

                        <td>
                            {{ $subscriber->subscriber_id }}
                        </td>

                        <td>
                            {{ $subscriber->sr_fname . ' ' . $subscriber->sr_lname }}
                        </td>

                        <td>
                            {{ $subscriber->sr_contactnum }}
                        </td>

                        <td>
                            {{ $subscriber->sr_street . ' ' . $subscriber->sr_barangay . ' ' . $subscriber->sr_city }}
                        </td>

                        <td>
                            {{ $subscriber->subscriptions->count() }}
                        </td>

                        <td>
                            {{ $subscriber->sr_status }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="summary">
            <p><strong>Number of Subscriber:</strong> {{$subscribers->count()}}</p>
        </div>

        <div class="prepared-by">
            <p><strong>Prepared By:</strong> Alex Ko</p>
            <p><strong>Date:</strong> {{ now()->format('Y-m-d') }}</p>

        </div>
    </div>
</body>

</html>
