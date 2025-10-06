<?php include 'db.php'; ?> 
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>CRUD mínim</title>
</head>
<body>
    <h1>Llista d’usuaris</h1>
    <table border="1"> <!-- Eliminada etiqueta <table> duplicada y colocado border correctamente -->
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Email</th>
            <th>Accions</th>
        </tr>
        <?php
        $result = $conn->query("SELECT * FROM users"); // Ejecuta consulta para traer usuarios
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                // Escapamos con htmlspecialchars para evitar XSS
                echo "<tr>
                        <td>" . htmlspecialchars($row['id']) . "</td>
                        <td>" . htmlspecialchars($row['name']) . "</td>
                        <td>" . htmlspecialchars($row['email']) . "</td>
                        <td>
                            <a href='edit.php?id=" . urlencode($row['id']) . "'>Editar</a> | 
                            <a href='delete.php?id=" . urlencode($row['id']) . "' onclick=\"return confirm('Segur que vols eliminar aquest usuari?');\">Eliminar</a> 
                            <!-- Añadido confirmación para evitar borrados accidentales -->
                        </td>
                     </tr>";
            }
        }
        ?>
    </table>

    <h2>Afegir usuari</h2>
    <form action="add.php" method="post"> <!-- Corregido el atributo method de "posts" a "post" -->
        Nom: <input type="text" name="name" required>
        Email: <input type="email" name="email" required>
        <button type="submit">Afegir</button>
    </form>
</body>
</html>
