<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JCLC Payment Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        header {
            text-align: left;
        }

        h1 {
            margin-bottom: 10px;
        }

        p {
            margin: 5px 0;
        }

        hr {
            margin: 20px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #dddddd;
            font-size: 10px;
        }

        th {
            background-color: #f2f2f2;
        }

        .total-amount {
            font-size: 1.2em;
            font-weight: bold;
            margin-top: 20px;
            text-align: right;
        }

        footer {
            text-align: center;
            margin-top: 20px;
            font-size: 0.9em;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>JCLC Billing Report</h1>
            <p><strong>Date:</strong> January 2022</p>
            <p><strong>Collector:</strong> Harry Dip</p>
            <hr>
        </header>

        <table>
            <thead>
                <tr> 
                    <th>Date</th>
                    <th>Subscriber Name</th>
                    <th>Subscription Number</th>
                    <th>Area</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($billingStatements as $billing)
                    <tr>
                        <td>{{ $billing->bs_billingdate}}</td>
                        <td>{{ $billing->subscription->subscriber->sr_fname }} {{ $billing->subscription->subscriber->sr_minitial }} {{ $billing->subscription->subscriber->sr_lname }}</td>
                        <td>{{ $billing->subscription->sn_num }}</td>
                        <td>{{ $billing->subscription->area->snarea_name }}</td>
                        <td>{{ $billing->bs_status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        

        <p><strong>Prepared By:</strong> Alex Ko</p>

        <footer>
            <p>&copy; 2022 JCLC. All rights reserved.</p>
        </footer>
    </div>
</body>
</html>
