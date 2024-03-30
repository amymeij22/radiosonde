<?php
// Koneksi ke database
$hostname = "localhost";
$username = "root";
$password = "";
$database = "radiosonde_db";

$conn = mysqli_connect($hostname, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Query untuk mengambil data dari tabel
$sql = "SELECT temperature, humidity, pressure, altitude, longitude, latitude FROM radiosonde";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // Nama file CSV
    $filename = 'data_radiosonde.csv';

    // Set header untuk membuat browser menganggap ini sebagai file yang akan didownload
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '"');

    // Buka file CSV untuk menulis
    $file = fopen('php://output', 'w');

    // Tulis header kolom ke file CSV
    fputcsv($file, ["Temperature", "Humidity", "Pressure", "Altitude", "Longitude", "Latitude"]);

    // Tulis setiap baris data ke file CSV
    while ($row = mysqli_fetch_assoc($result)) {
        fputcsv($file, $row);
    }

    // Tutup file CSV
    fclose($file);
} else {
    echo "0 results";
}

// Tutup koneksi database
mysqli_close($conn);
?>
