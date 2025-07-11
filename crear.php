<?php include 'db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $disponible = isset($_POST['disponible']) ? 1 : 0;

    $stmt = $conn->prepare("INSERT INTO platillos (nombre, descripcion, precio, disponible) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssdi", $nombre, $descripcion, $precio, $disponible);
    $stmt->execute();

    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Agregar Platillo</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Agregar Nuevo Platillo</h1>
    <form method="post">
        <label>Nombre:</label><br>
        <input type="text" name="nombre" required><br>
        <label>Descripción:</label><br>
        <textarea name="descripcion"></textarea><br>
        <label>Precio:</label><br>
        <input type="number" name="precio" step="0.01" required><br>
        <label>Disponible:</label>
        <input type="checkbox" name="disponible" checked><br><br>
        <button type="submit">Guardar</button>
        <a href="index.php">Cancelar</a>
    </form>
</body>
</html>