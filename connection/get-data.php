<?php

$hostname = "localhost";
$username = "root";
$password = "";
$database = "radiosonde_db";

$conn = mysqli_connect($hostname, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

echo "Database connection is OK<br>";

if(isset($_POST["temperature"]) && isset($_POST["humidity"]) && isset($_POST["pressure"]) && isset($_POST["altitude"]) && isset($_POST["longitude"]) && isset($_POST["latitude"])) {

    $t = $_POST["temperature"];
    $h = $_POST["humidity"];
    $p = $_POST["pressure"];
    $alt = $_POST["altitude"];
    $long = $_POST["longitude"];
    $lat = $_POST["latitude"];

    $sql = "INSERT INTO radiosonde (temperature, humidity, pressure, altitude, longitude, latitude) VALUES ('$t', '$h', '$p', '$alt', '$long', '$lat')";

    if (mysqli_query($conn, $sql)) {
        echo "\nNew record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

?>
