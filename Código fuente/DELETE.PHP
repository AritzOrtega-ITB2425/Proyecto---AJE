<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    // Corregido SQL DELETE: se usa "DELETE FROM", no "DELETE * FROM"
    $stmt = $conn->prepare("DELETE FROM users WHERE id=?");
    if ($stmt === false) { // Comprobamos errores en la preparación
        die("Error en la preparación de la consulta: " . $conn->error);
    }

    $stmt->bind_param("i", $id);

    if (!$stmt->execute()) { // Comprobamos errores en la ejecución
        die("Error en la ejecución de la consulta: " . $stmt->error);
    }

    $stmt->close();

    header("Location: index.php"); // Redirigimos tras eliminar
    exit;
} else {
    die("ID no proporcionat."); // Si no hay ID, mostramos error
}
?>
