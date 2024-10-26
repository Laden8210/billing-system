<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JCLC Announcement Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
            font-size: 1em; /* Regular text size */
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
            text-align: center;
        }

        h1 {
            margin-bottom: 10px;
            font-size: 1.5em; /* Adjusted to a regular heading size */
        }

        h3 {
            margin: 3px 0; /* Reduced margin for h3 */
            font-size: 1.2em; /* Slightly larger font for clarity */
        }

        p {
            margin: 2px 0; /* Reduced margin for p */
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
            font-size: 0.9em; /* Regular text size for table content */
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

        <h3>Complaint Report</h3>
        <p><strong>From:</strong> {{ \Carbon\Carbon::parse($start)->format('F j, Y') }} - {{ \Carbon\Carbon::parse($end)->format('F j, Y') }}</p>

        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Subscriber</th>
                    <th>Complaint</th>
                    <th>Reply</th>
                </tr>
            </thead>
            <tbody>
                @foreach($complaints as $complaint)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($complaint->an_date)->format('m/d/Y') }}</td>
                        <td> {{$complaint->subscriber->sr_fname}} {{$complaint->subscriber->sr_lname}}</td>
                        <td> {{$complaint->cp_message}}</td>
                        <td>{{$complaint->cp_reply ?? 'No Reply'}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <p><strong>Prepared By:</strong> {{ Auth::user()->em_fname . ' ' . Auth::user()->em_lname }}</p>
        <p><strong>Printed Date:</strong> {{ now()->format('m/d/Y') }}</p>

        <footer></footer>
    </div>
</body>
</html>
