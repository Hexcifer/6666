<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "ujian3";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

function getArticles($conn) {
    $sql = "SELECT * FROM articles ORDER BY publication_date DESC";
    $result = $conn->query($sql);

    $articles = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $articles[] = $row;
        }
    }
    return $articles;
}
?>
