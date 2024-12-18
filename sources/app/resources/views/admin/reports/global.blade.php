<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        Global Report
    </title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
        }

        h1 {
            text-align: center;
            color: #4CAF50;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        .section-title {
            margin-top: 30px;
            font-size: 1.5em;
            color: #333;
        }

        .stat-table td {
            font-weight: bold;
        }

        .stat-table td:first-child {
            text-align: left;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Global Report</h1>

    <div>
        <h2 class="section-title">
            General Statistics for the Month
        </h2>
        <table>
            <tr>
                <th>
                    Metric
                </th>
                <th>
                    Count
                </th>
            </tr>
            <tr>
                <td>
                    New Users
                </td>
                <td>
                    {{ $data['countUsers'] }}
                </td>
            </tr>
            <tr>
                <td>
                    New Trainings
                </td>
                <td>
                    {{ $data['countTrainings'] }}
                </td>
            </tr>
            <tr>
                <td>
                    New Memberships
                </td>
                <td>
                    {{ $data['countMemberships'] }}
                </td>
            </tr>
            <tr>
                <td>
                    Memberships Purchased
                </td>
                <td>
                    {{ $data['countMembershipsPurchased'] }}
                </td>
            </tr>
        </table>
    </div>

    <div>
        <h2 class="section-title">
            Membership Purchases Statistics
        </h2>
        <table class="stat-table">
            <tr>
                <th>
                    ID
                </th>
                <th>
                    Membership
                </th>
                <th>
                    Purchases
                </th>
            </tr>
            @foreach($data['statisticEachMembership'] as $statistic)
                <tr>
                    <td>
                        {{ $statistic->membership_id }}
                    </td>
                    <td>
                        {{ $statistic->name }}
                    </td>
                    <td>
                        {{ $statistic->count }}
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
</div>
</body>
</html>
