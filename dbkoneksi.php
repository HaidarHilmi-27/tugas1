<?php
$host = "localhost";
$dbname = "dbpuskesmas";
$user = "root";
$pass = "";

try {
    $dbh = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
} catch (PDOException $e) {
    echo "Koneksi gagal: " . $e->getMessage();
}
?>
