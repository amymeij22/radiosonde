<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="5"> <!-- Refresh otomatis setiap 30 detik -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Radiosonde</title>
        <link rel="stylesheet" href="style.css" type="text/css">

    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
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

<h2>Data Radiosonde </h2>

<table>
    <tr>
        <th>ID</th>
        <th>Date Time</th>
        <th>Temperature</th>
        <th>Humidity</th>
        <th>Pressure</th>
        <th>Altitude</th>
        <th>Longitude</th>
        <th>Latitude</th>
    </tr>
    <?php
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $database = "radiosonde_db";

    $conn = mysqli_connect($hostname, $username, $password, $database);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM radiosonde ORDER BY datetime DESC LIMIT 1"; // Menampilkan hanya satu baris terakhir
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["datetime"] . "</td>";
        echo "<td>" . $row["temperature"] . "</td>";
        echo "<td>" . $row["humidity"] . "</td>";
        echo "<td>" . $row["pressure"] . "</td>";
        echo "<td>" . $row["altitude"] . "</td>";
        echo "<td>" . $row["longitude"] . "</td>";
        echo "<td>" . $row["latitude"] . "</td>";
        echo "</tr>";
    } else {
        echo "0 results";
    }
    mysqli_close($conn);
    ?>
</table>

<script>
    setInterval(function() {
        location.reload(); // Melakukan refresh halaman setiap 30 detik
    }, 30000); // Setiap 30 detik
</script>

</body>
</html>
