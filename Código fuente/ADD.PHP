<?php
include 'db.php';

if (isset($_POST['name'], $_POST['email'])) { // Validamos que lleguen los datos
    $name  = $_POST['name'];
    $email = $_POST['email'];

    // Preparación de la consulta segura evitando inyección SQL
    $stmt = $conn->prepare("INSERT INTO users (name, email) VALUES (?, ?)");
    if ($stmt === false) { // Comprobamos errores en la preparación
        die("Error en la preparación de la consulta: " . $conn->error);
    }

    $stmt->bind_param("ss", $name, $email); // Indicamos los tipos y valores

    if (!$stmt->execute()) { // Comprobamos errores en la ejecución
        die("Error al ejecutar la consulta: " . $stmt->error);
    }

    $stmt->close();

    header("Location: index.php"); // Redireccionamos tras insertar
    exit;
} else {
    die("Datos incompletos."); // Si falta algún dato, informamos
}
?>
