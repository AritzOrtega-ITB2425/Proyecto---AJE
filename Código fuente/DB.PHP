<?php
$servername = "localhost"; // Corregido error ortográfico ("locahost" -> "localhost")
$username = "root";
$password = "root";
$dbname = "crud_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) { 
    die("Connexió fallida: " . $conn->connect_error); // Cerrada la llave correctamente
}
?>
