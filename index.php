<?php include 'autor.php'; include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Menú de Mariscos</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <h1>Menú del Restaurante de Mariscos</h1>
    <p><a href="crear.php" class="btn">Agregar Platillo</a> | <a href="cierredesecion.php">Cerrar sesión</a></p>
    
    <form method="get" action="index.php">
        <input type="text" name="buscar" placeholder="Buscar platillo..." value="<?= $_GET['buscar'] ?? '' ?>">
        <button type="submit">Buscar</button>
    </form>

    <table>
        <tr><th>Nombre</th><th>Descripción</th><th>Precio</th><th>Disponible</th><th>Acciones</th></tr>
        <?php
        $condicion = "";
        if (!empty($_GET['buscar'])) {
            $busqueda = "%" . $_GET['buscar'] . "%";
            $stmt = $conn->prepare("SELECT * FROM platillos WHERE nombre LIKE ?");
            $stmt->bind_param("s", $busqueda);
            $stmt->execute();
            $result = $stmt->get_result();
        } else {
            $result = $conn->query("SELECT * FROM platillos");
        }

        while ($row = $result->fetch_assoc()):
        ?>
        <tr>
            <td><?= $row['nombre'] ?></td>
            <td><?= $row['descripcion'] ?></td>
            <td>$<?= $row['precio'] ?></td>
            <td><?= $row['disponible'] ? 'Sí' : 'No' ?></td>
            <td>
                <a href="editar.php?id=<?= $row['id'] ?>">Editar</a> |
              <a href="borrar.php?id=<?= $row['id'] ?>" onclick="event.preventDefault(); if(confirm('¿Eliminar este platillo?')) { window.location.href=this.href; }">
  🗑️ Eliminar
</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>