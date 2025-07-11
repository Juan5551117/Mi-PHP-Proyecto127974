<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Menú de Mariscos</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <h1>Menú del Restaurante de Mariscos</h1>
    <p> | <a href="cierredesecion2.php">Cerrar sesión</a></p>
    
    <form method="get" action="paginainicial.php">
        <input type="text" name="buscar" placeholder="Buscar platillo..." value="<?= $_GET['buscar'] ?? '' ?>">
        <button type="submit">Buscar</button>
    </form>

    <table>
        <tr><th>Nombre</th><th>Descripción</th><th>Precio</th><th>Disponible</th>
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
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>