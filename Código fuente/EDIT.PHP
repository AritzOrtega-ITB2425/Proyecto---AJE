<?php
include 'db.php';

$user = null;

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $result = $conn->query("SELECT * FROM users WHERE id=$id");
    if ($result && $result->num_rows === 1) { // Verificamos que exista el usuario
        $user = $result->fetch_assoc();
    } else {
        die("Usuari no trobat."); // Si no existe, mostramos error
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id    = (int)$_POST['id'];
    $name  = $_POST['name'];
    $email = $_POST['email'];

    // Corregido el SQL UPDATE, agregando SET y evitando errores de sintaxis
    $stmt = $conn->prepare("UPDATE users SET name=?, email=? WHERE id=?");
    if ($stmt === false) { // Comprobamos errores en la preparación
        die("Error en la preparación de la consulta: " . $conn->error);
    }

    $stmt->bind_param("ssi", $name, $email, $id);

    if (!$stmt->execute()) { // Comprobamos errores en la ejecución
        die("Error en la ejecución de la consulta: " . $stmt->error);
    }

    $stmt->close();

    header("Location: index.php"); // Redirigimos tras actualizar
    exit;
}
?>

<?php if ($user): ?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Editar usuari</title>
</head>
<body>
    <h1>Editar usuari</h1>
    <form method="post">
        <!-- Escapamos salida para evitar XSS -->
        <input type="hidden" name="id" value="<?= htmlspecialchars($user['id']) ?>">
        Nom: <input type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>" required>
        Email: <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
        <button type="submit">Desar</button>
    </form>
</body>
</html>
<?php endif; ?>
