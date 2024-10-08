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
            font-size: 1.8em; /* Increased for better visibility */
        }

        h3 {
            margin: 20px 0 10px;
            font-size: 1.5em; /* Increased for better visibility */
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
            font-size: 12px; /* Increased for better readability */
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold; /* Added bold font for headers */
        }

        .total-amount {
            font-size: 1em; /* Slightly increased for visibility */
            font-weight: bold;
            margin-top: 20px;
            text-align: right;
        }

        footer {
            text-align: center;
            margin-top: 20px;
            font-size: 0.9em;
        }

        /* Responsive Design */
        @media (max-width: 600px) {
            th, td {
                font-size: 10px; /* Smaller font size on smaller screens */
                padding: 8px; /* Less padding for smaller screens */
            }

            h1, h3 {
                font-size: 1.2em; /* Reduced heading sizes */
            }

            .total-amount {
                font-size: 0.9em; /* Reduced total amount font size */
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>JCLC Internet Service</h1>
            <p><strong>From:</strong> {{$start ."-".  $end}}</p>
            <hr>
        </header>

        <h3>Collection Report</h3>

        <table>
            <thead>
                <tr>
                    <th>Subscriber Name</th>
                    <th>Employee Name</th>
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
                        <td>{{ $payment->p_amount }}</td>
                        <td>{{ $payment->p_date }}</td>
                        <td>{{ $payment->billingStatement->subscription->area->snarea_name }}</td>
                        <td>{{ $payment->billstatement_id ?? 0 }}</td>
                        <td>{{ $payment->p_amount }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <p class="total-amount"><strong>Total Amount Collected:</strong> P {{ $payments->sum('p_amount') }}</p>

        <p><strong>Prepared By:</strong> Alex Ko</p>
    </div>
</body>
</html>
