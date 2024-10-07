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

        /* Styles for images in the table */
        .proof-image {
            width: 100px;
            height: auto;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <div class="report-container">
        <h1>JCLC Remittance Report</h1>
        <div class="report-header">
            <p><strong>From:</strong> 10/02/2004 - 10/07/2024</p>
            <p><strong>Area:</strong> Tupi</p>
        </div>

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
                <?php
                // Dummy employee data array
                $employees = [
                    ['em_fname' => 'John', 'em_lname' => 'Doe', 'rm_date' => '10/02/2024', 'rm_amount' => '5000', 'rm_image' => 'proof1.jpg'],
                    ['em_fname' => 'Jane', 'em_lname' => 'Smith', 'rm_date' => '10/03/2024', 'rm_amount' => '4500', 'rm_image' => 'proof2.jpg'],
                    ['em_fname' => 'Alex', 'em_lname' => 'Johnson', 'rm_date' => '10/04/2024', 'rm_amount' => '3000', 'rm_image' => 'proof3.jpg'],
                    ['em_fname' => 'Sarah', 'em_lname' => 'Brown', 'rm_date' => '10/05/2024', 'rm_amount' => '5500', 'rm_image' => 'proof4.jpg'],
                ];

                foreach ($employees as $employee) {
                    echo "<tr>
                        <td>{$employee['em_fname']} {$employee['em_lname']}</td>
                        <td>{$employee['rm_date']}</td>
                        <td>{$employee['rm_amount']}</td>
                        <td><img src='storage/{$employee['rm_image']}' class='proof-image' alt='Proof Image' /></td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>

        <div class="prepared-by">
            <p><strong>Prepared By:</strong> Alex Ko</p>
            <p><strong>Date:</strong> <?php echo date('m-d-Y'); ?></p>
        </div>
    </div>
</body>

</html>
