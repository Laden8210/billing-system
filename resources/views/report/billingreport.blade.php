<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JCLC Billing Report</title>
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
            text-align: Center;
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
            font-size: 0.8em;
            font-weight: bold;
            margin-top: 20px;
            text-align: right;
        }

        footer {
            text-align: center;
            margin-top: 20px;
            font-size: 0.9em;
        }
        .location-name {
            font-size: 0.6em; 
            font-weight: normal;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>JCLC Internet Servece</h1>
            <h1><span class="location-name">Urban 2, Koronadal City</span></h1>
            
            <hr>
        </header>

        <h3>Billing Report</h3>
        <p><strong>From:</strong> {{ \Carbon\Carbon::parse($start)->format('F j, Y') }} - {{ \Carbon\Carbon::parse($end)->format('F j, Y') }}</p>

        <p><strong>Area:</strong> {{$areaName}}</p>

        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Subscriber Name</th>
                    <th>Subscription Number</th>
                    <th>Area</th>
                    <th>Subscription Plan</th>
                    <th>Status</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                @php
                $sum =0;
                @endphp
                @foreach($billingStatements as $billing)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($billing->bs_billingdate)->format('m/d/Y') }}</td>
                    <td>{{ $billing->subscription->subscriber->sr_fname }} {{ $billing->subscription->subscriber->sr_minitial }} {{ $billing->subscription->subscriber->sr_lname }}</td>
                    <td>{{ $billing->subscription->sn_num }}</td>
                    <td>{{ $billing->subscription->area->snarea_name }}</td>
                    <td>{{ $billing->subscription->plan->snplan_bandwidth }} MBps</td>
                    <td>{{ $billing->bs_status }}</td>

                    @php
                        // Calculate total payment amount for the billing statement
                        $totalPaymentAmount = $billing->payments->sum('p_amount');
                        $sum = $totalPaymentAmount + $sum
                    @endphp

                    <td>         <span style="font-family: DejaVu Sans;">&#x20B1;</span>{{ number_format($totalPaymentAmount, 2) }}</td> <!-- Format the amount to 2 decimal places -->
                </tr>
                @endforeach

            </tbody>
        </table>
        <p class="total-amount"><strong>Total Amount Collected:</strong> <span style="font-family: DejaVu Sans;">&#x20B1;</span> {{ number_format($sum , 2) }}</p>



        <p><strong>Prepared By:</strong> Alex Ko</p>
        <p><strong>Printed Date:</strong> {{ now()->format('m/d/Y') }}</p>


    </div>
</body>
</html>
