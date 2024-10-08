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
            padding: 10px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        header {
            text-align: center;
        }

        h1 {
            margin-bottom: 5px;
            font-size: 1.5em;
            color: #333;
        }

        h3 {
            margin: 15px 0 10px;
            font-size: 1.3em;
            color: #555;
        }

        p {
            margin: 5px 0;
            color: #666;
        }

        hr {
            margin: 15px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 5px;
            text-align: left;
            border: 1px solid #dddddd;
            font-size: 10px;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
            color: #333;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .total-amount {
            font-size: 1em;
            font-weight: bold;
            margin-top: 20px;
            text-align: right;
            color: #333;
        }

        footer {
            text-align: center;
            margin-top: 20px;
            font-size: 0.9em;
            color: #666;
        }

        @media (max-width: 600px) {
            th, td {
                font-size: 8px;
                padding: 4px;
            }

            h1, h3 {
                font-size: 1.2em;
            }

        }
        
        .total-amount {
            font-size: 12px;
            text-align: right; /* Align the total amount to the right */
            margin-top: 10px;
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

        <h3>Collection Report</h3>
        <p><strong>From:</strong> {{ \Carbon\Carbon::parse($start)->format('F j, Y') }} - {{ \Carbon\Carbon::parse($end)->format('F j, Y') }}</p>


        <table>
            <thead>
                <tr>
                    <th>Subscriber Name</th>
                    <th>Collector Name</th>
                    <th>Subscription Number</th>
                    <th>Subscription Plan</th>
                    <th>Subscription Fee</th>
                    <th>Payment Date</th>
                    <th>Area</th>
                    <th>Billing Statement ID</th>
                    <th>Amount Paid</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($payments as $payment)
                    <tr>
                        <td>{{ $payment->billingStatement->subscription->subscriber->sr_fname . " " . $payment->billingStatement->subscription->subscriber->sr_lname }}</td>
                        <td>{{ $payment->employee->em_fname . " " . $payment->employee->em_lname }}</td>
                        <td>{{ $payment->billingStatement->subscription->sn_num }}</td>
                        <td>{{ $payment->billingStatement->subscription->plan->snplan_bandwidth }}</td>
                        <td><span style="font-family: DejaVu Sans;">&#x20B1;</span>{{ number_format($payment->p_amount, 2) }}</td> <!-- Formatted amount -->
                        <td>{{ \Carbon\Carbon::parse($payment->p_date)->format('m-d-Y') }}</td>
                        <td>{{ $payment->billingStatement->subscription->area->snarea_name }}</td>
                        <td>{{ $payment->billstatement_id ?? 0 }}</td>
                        <td><span style="font-family: DejaVu Sans;">&#x20B1;</span>{{ number_format($payment->p_amount, 2) }}</td> <!-- Formatted amount -->
                    </tr>
                @endforeach
            </tbody>
        </table>

        <p class="total-amount"><strong>Total Amount Collected:</strong> <span style="font-family: DejaVu Sans;">&#x20B1;</span></strong> {{ number_format($payments->sum('p_amount'), 2) }}</p> <!-- Formatted total amount -->

        <p><strong>Prepared by:</strong> Alex Ko</p>
        <p><strong>Print date:</strong> {{ now()->format('m/d/Y') }}</p>
    </div>
</body>
</html>
