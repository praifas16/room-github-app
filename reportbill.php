<?php
session_start();

$host = 'localhost';
$dbname = 'Junsuriya';
$username = 'root';
$password = 'root';

$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get current month
$currentMonth = date('m');

// Prepare SQL statement to fetch payment details for the current month
$sql = "SELECT pd.Mem_ID, m.Mem_Name, m.Room_ID, pd.Water_Bill, pd.Elec_Bill, pd.Total, DATE_FORMAT(pd.Date, '%Y-%m-%d') AS Date, pd.QR 
        FROM PaymentDetail pd
        INNER JOIN Member m ON pd.Mem_ID = m.Mem_ID
        WHERE MONTH(pd.Date) = $currentMonth";

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Details Report</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>

    <h2>Payment Details Report for Current Month</h2>

    <table>
        <thead>
            <tr>
                <th>Mem_ID</th>
                <th>Mem_Username</th>
                <th>Room_ID</th>
                <th>Water_Bill</th>
                <th>Elec_Bill</th>
                <th>Total</th>
                <th>Date</th>
                <th>QR</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["Mem_ID"] . "</td>";
                    echo "<td>" . $row["Mem_Name"] . "</td>";
                    echo "<td>" . $row["Room_ID"] . "</td>";
                    echo "<td>" . $row["Water_Bill"] . "</td>";
                    echo "<td>" . $row["Elec_Bill"] . "</td>";
                    echo "<td>" . $row["Total"] . "</td>";
                    echo "<td>" . $row["Date"] . "</td>";
                    echo "<td>" . $row["QR"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='8'>No payment details found for the current month.</td></tr>";
            }
            ?>
        </tbody>
    </table>

</body>

</html>

<?php
$conn->close();
?>