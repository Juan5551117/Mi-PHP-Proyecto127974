<?php include 'db.php';
$id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $disponible = isset($_POST['disponible']) ? 1 : 0;

    $stmt = $conn->prepare("UPDATE platillos SET nombre=?, descripcion=?, precio=?, disponible=? WHERE id=?");
    $stmt->bind_param("ssdii", $nombre, $descripcion, $precio, $disponible, $id);
    $stmt->execute();

    header("Location: index.php");
} else {
    $stmt = $conn->prepare("SELECT * FROM platillos WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $platillo = $stmt->get_result()->fetch_assoc();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Editar Platillo</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Editar Platillo</h1>
    <form method="post">
        <label>Nombre:</label><br>
        <input type="text" name="nombre" value="<?= $platillo['nombre'] ?>" required><br>
        <label>Descripción:</label><br>
        <textarea name="descripcion"><?= $platillo['descripcion'] ?></textarea><br>
        <label>Precio:</label><br>
        <input type="number" name="precio" step="0.01" value="<?= $platillo['precio'] ?>" required><br>
        <label>Disponible:</label>
        <input type="checkbox" name="disponible" <?= $platillo['disponible'] ? 'checked' : '' ?>><br><br>
        <button type="submit">Actualizar</button>
        <a href="index.php">Cancelar</a>
    </form>
</body>
</html>