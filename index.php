<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="5"> <!-- Refresh otomatis setiap 30 detik -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Radiosonde</title>
    <link rel="stylesheet" href="./css/style.css" type="text/css">
    <link rel="icon" type="image/png" href="https://icon-icons.com/icons2/317/PNG/512/dashboard-alt-icon_34459.png">
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
    } else {
        echo "0 results";
    }
    mysqli_close($conn);
    ?>

</head>
<body>
    <div class="container">
        <div class="button-container">
            <form action="./connection/download.php" method="post">
                <button type="submit">Download Data (.csv)</button>
            </form>
            </div>
        <div class="weather__body">  
            <div class="weather__minmax">
                <p>Date Time</p>
                <p class="weather__pressure"><?php echo $row["datetime"];?></p>
            </div>
        </div>
        <div class="weather__info">
            <div class="weather__card">
                <i class="fa-solid fa-temperature-low"></i>
                <div>
                    <p>Suhu</p>
                    <p class="weather__humidity"><?php echo $row["temperature"];?> &#176C</p>
                </div>
            </div>
            <div class="weather__card">
                <i class="fa-solid fa-droplet"></i>
                <div>
                    <p>Kelembaban</p>
                    <p class="weather__humidity"><?php echo $row["humidity"];?> %</p>
                </div>
            </div>
            <div class="weather__card">
                <i class="fa-solid fa-gauge-high"></i>
                <div>
                    <p>Tekanan Udara</p>
                    <p class="weather__pressure"><?php echo $row["pressure"];?> hPa</p>
                </div>
            </div>
            <div class="weather__card2">
                <div class="card1">
                    <p>Altitude</p>
                    <p class="weather__pressure"><?php echo $row["altitude"];?> mdpl</p>
                </div>
                <div class="card1">
                    <p>Longitude</p>
                    <p class="weather__pressure"><?php echo $row["longitude"];?></p>
                </div>
                <div class="card1">
                    <p>Latitude</p>
                    <p class="weather__pressure"><?php echo $row["latitude"];?></p>
                </div>
            </div>  
        </div>
        <div>
            <h5 class="insD">&#169 2024 Copyright Instrumentasi 4D. All Right Reserved.</h5>
        </div>
    </div>
    <script src="https://kit.fontawesome.com/a692e1c39f.js" crossorigin="anonymous"></script>
</body>
</html>
